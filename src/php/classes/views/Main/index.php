<section class="statistics">

  <!-- Grid container -->
  <div class="container">
    <h3 class="text-center">Analitics</h3>

    <!--Grid row-->
    <div class="row d-flex justify-content-center align-items-center">

      <!--Grid column-->
<!--      <div class="col-md-6">-->
<!--        <canvas id="barChart"></canvas>-->
<!--      </div>-->
      <div class="col-md-6">
        <div class="statistic-table">
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Группа</th>
              <th scope="col">Бюджет SUP</th>
              <th scope="col">Бюджет добавлено</th>
              <th scope="col">Бюджет итого</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($statistic as $user): ?>
            <tr>
              <th scope="row"><?= $user['short_condition'] ?></th>
              <td><?= number_format($user['sup_source'], 0, '.', ' '); ?></td>
              <td><?= number_format($user['sup_confirm'], 0, '.', ' '); ?></td>
              <td><?= number_format($user['sup_total'], 0, '.', ' '); ?></td>
            </tr>
            </tbody>
            <?php endforeach; ?>
          </table>
        </div>
      </div>

    </div>

  </div>

</section>