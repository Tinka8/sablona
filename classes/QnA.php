<?php
namespace otazkyodpovede;

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/db/config.php');
use PDO;
class QnA{
    private $conn;
    public function __construct() {
        $this->connect();
    }
    private function connect() {
        $config = DATABASE;

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        );
        try {
            $this->conn = new PDO('mysql:host=' . $config['HOST'] . ';dbname=' .
                $config['DBNAME'] . ';port=' . $config['PORT'], $config['USER_NAME'],
                $config['PASSWORD'], $options);
        } catch (PDOException $e) {
            die("Chyba pripojenia: " . $e->getMessage());
        }
    }

    public function insertQnA(){
        try {
            // Načítanie JSON súboru
            $data = json_decode(file_get_contents
            (__ROOT__.'/data/datas.json'), true);
            $otazky = $data["otazky"];
            $odpovede = $data["odpovede"];

            // Vloženie otázok a odpovedí v rámci transakcie
            $this->conn->beginTransaction();

            $sql = "INSERT INTO qna (otazka, odpoved) VALUES (:otazka, :odpoved)";
            $statement = $this->conn->prepare($sql);

            $select = "SELECT COUNT(*) FROM qna WHERE otazka like :otazka";
            $check = $this->conn->prepare($select);

            for ($i = 0; $i < count($otazky); $i++) {
                $check->bindParam(':otazka', $otazky[$i]);
                $check->execute();

                if ($check->fetchColumn() > 0) {
                    continue;
                }

                $statement->bindParam(':otazka', $otazky[$i]);
                $statement->bindParam(':odpoved', $odpovede[$i]);
                $statement->execute();
            }
            $this->conn->commit();
        } catch (Exception $e) {
            // Zobrazenie chybového hlásenia
            echo "Chyba pri vkladaní dát do databázy: " . $e->getMessage();
            $this->conn->rollback(); // Vrátenie späť zmien v prípade chyby
        }
    }

    /**
     * Získanie otázok a odpovedí
     *
     * @return array Otázky a odpovede (['otazka' => string, 'odpoved' => string])
     */
    public function getQnA(): array {

        $sql = "SELECT otazka, odpoved FROM qna";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $qna = $statement->fetchAll();
        return $qna;

    }
    /**
     * Uzavretie spojenia s databázou
     */
    public function __destruct() {
        $this->conn = null;
    }

}
