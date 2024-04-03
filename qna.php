<?php
include_once "parts/header.php";
?>
<body>
<?php
include_once "parts/nav.php";
?>
  <main>
    <section class="banner">
      <div class="container text-white">
        <h1>Q&A</h1>
      </div>
    </section>
    <section class="container">
      <div class="row">
        <div class="col-100 text-center">
          <p><strong><em>Elit culpa id mollit irure sit. Ex ut et ea esse culpa officia ea incididunt elit velit veniam qui. Mollit deserunt culpa incididunt laborum commodo in culpa.</em></strong></p>
        </div>
      </div>
    </section>
          <?php
           include_once "classes/QnA.php";
           use otazkyodpovede\QnA;

          $qna = new QnA();
          // $qna->insertQnA();
          ?>

          <?php foreach($qna->getQnA() as $qna): ?>
            <section class="container">
              <div class="row">
                <div class="col-100">
                  <h4><?= $qna['otazka'] ?></h4>
                  <p><?= $qna['odpoved'] ?></p>
                </div>
              </div>
            </section>
          <?php endforeach; ?>
  </main>
  <?php
include_once "parts/footer.php"
?>