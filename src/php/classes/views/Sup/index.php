<!--FILTER-->
<section class="filters">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="form-header">Фильтры отчета</h2>
      </div>
    </div>
    <div class="row">
      <form class="filter-form" method="post">
        <div class="form-row">
          <label>
            <select id="buyer" name="buyer">
              <option style="display: none" selected>BUYER</option>
              <?php foreach ($buyers as $value): ?>
                <option><?= $value['BUYER'] ?></option>
              <?php endforeach; ?>
            </select>
          </label>
          <label>
            <select id="group" name="group">
              <option style="display: none" selected>GROUP</option>
              <?php foreach ($groups as $value): ?>
                <option><?= $value['GROUPE'] ?></option>
              <?php endforeach; ?>
            </select>
          </label>

          <label>
            <input type="text" class="form-control" placeholder="Дата с:" name="date-from" id="from" <?= date("Y.m.01") ?> autocomplete="off" required>
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </label>

          <label>
            <input type="text" class="form-control" placeholder="Дата по:" name="date-to" id="to" <?= date("Y.m.01") ?> autocomplete="off" required>
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </label>

        </div>
        <div class="form-row">
          <label>
            <input id="frs" name="supplier" type="text" placeholder="supplier">
          </label>
          <label>
            <input id="article" name="article" type="text" placeholder="article">
          </label>
          <button class="filter-btn" name="submit" type="submit">Применить<i class="fas fa-filter"></i></button>
          <button class="reset-btn" title="Сбросить фильтры"><i class="fas fa-power-off"></i></button>
          <button class="excel-btn" name="to-excel">В Excel<i class="far fa-file-excel"></i></button>
        </div>
      </form>
    </div>
  </div>
</section>

<!--REPORT TABLE-->
<section class="report-table">
  <div class="table-box">
    <table id="sup-report-table">
      <?php if($table): ?>
      <thead>
        <tr>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][0] == 1) {
            echo "<th data-colIndex=\"0\">Start_date<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"0\" style=\"display: none\">Start_date<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][1] == 1) {
            echo "<th data-colIndex=\"1\">End_date<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"1\" style=\"display: none\">End_date<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][2] == 1) {
            echo "<th data-colIndex=\"2\">Buyer<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"2\" style=\"display: none\">Buyer<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][3] == 1) {
            echo "<th data-colIndex=\"3\">Group<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"3\" style=\"display: none\">Group<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][4] == 1) {
            echo "<th data-colIndex=\"4\">Week<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"4\" style=\"display: none\">Week<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][5] == 1) {
            echo "<th data-colIndex=\"5\">Segm<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"5\" style=\"display: none\">Segm<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][6] == 1) {
            echo "<th data-colIndex=\"6\">№ пост.<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"6\" style=\"display: none\">№ пост.<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][7] == 1) {
            echo "<th data-colIndex=\"7\">Назв. пост<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"7\" style=\"display: none\">Назв. пост<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][8] == 1) {
            echo "<th data-colIndex=\"8\">Article<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"8\" style=\"display: none\">Article<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][9] == 1) {
            echo "<th data-colIndex=\"9\">Type<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"9\" style=\"display: none\">Type<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][10] == 1) {
            echo "<th data-colIndex=\"10\">Ошибка<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"10\" style=\"display: none\">Ошибка<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][11] == 1) {
            echo "<th data-colIndex=\"11\">Total<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"11\" style=\"display: none\">Total<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <?php
          if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][11] == 1) {
            echo "<th data-colIndex=\"12\">Tarif<i class=\"fas fa-thumbtack\"></i></th>";
          } else {
            echo "<th data-colIndex=\"12\" style=\"display: none\">Tarif<i class=\"fas fa-thumbtack\"></i></th>";
          }
          ?>
          <th>001 <span>PETR</span></th>
          <th>003 <span>KILTS</span></th>
          <th>007 <span>BELICH</span></th>
          <th>009 <span>LVIV</span></th>
          <th>010 <span>RAD</span></th>
          <th>011 <span>ZAPOROG</span></th>
          <th>012 <span>KRIV.R</span></th>
          <th>014 <span>RIVE G</span></th>
          <th>015 <span>LIBI</span></th>
          <th>016 <span>FONT</span></th>
          <th>018 <span>TCHERN</span></th>
          <th>020 <span>PIVD</span></th>
          <th>022 <span>LVIV</span></th>
          <th>023 <span>Hluck</span></th>
          <th>024 <span>Sosn</span></th>
          <th>025 <span>LUGOV</span></th>
          <th>026 <span>Kharkiv</span></th>
          <th>027 <span>Tarasiv</span></th>
          <th>028 <span>Khark</span></th>
          <th>029 <span>DNIPR</span></th>
          <th>030 <span>Zhytom</span></th>
          <th>031 <span>Chern</span></th>
          <th>032 <span>Вильям</span></th>
          <th>033 <span>Лепсе</span></th>
          <th>034 <span>Правди</span></th>
          <th>035 <span>Фрунзе</span></th>
          <th>037 <span>DAFI</span></th>
        </tr>
      </thead>
        <tbody>
        <?php
        foreach ($table as $val):
          ?>
          <tr>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][0] == 1): ?>
            <td class="dateFrom" data-colIndex="0"><?= date("d.m.Y", strtotime($val['start_date'])) ?></td>
            <?php else: ?>
            <td class="dateFrom" data-colIndex="0" style="display: none"><?= date("d.m.Y", strtotime($val['start_date'])) ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][1] == 1): ?>
            <td class="dateTo" data-colIndex="1"><?= date("d.m.Y", strtotime($val['end_date'])) ?></td>
            <?php else: ?>
            <td class="dateTo" data-colIndex="1" style="display: none"><?= date("d.m.Y", strtotime($val['end_date'])) ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][2] == 1): ?>
            <td data-colIndex="2"><?= $val['buyer'] ?></td>
            <?php else: ?>
            <td data-colIndex="2" style="display: none"><?= $val['buyer'] ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][3] == 1): ?>
            <td data-colIndex="3"><?= $val['short_condition'] ?></td>
            <?php else: ?>
            <td data-colIndex="3" style="display: none"><?= $val['short_condition'] ?></td>
            <?php endif; ?>

            <!--Промо период АШАН-->
            <?php
            $startDay = date("w", strtotime($val['start_date']));
            $startWeek = date("W", strtotime($val['start_date']));
            $startPeriod = $startDay < 3 ? $startWeek - 1 : $startWeek;

            $endDay = date("w", strtotime($val['end_date']));
            $endWeek = date("W", strtotime($val['end_date']));
            $endPeriod = $endDay < 3 ? $endWeek - 1 : $endWeek;
            if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][4] == 1):
            ?>
            <td data-colIndex="4"><?= $startPeriod . '-' . $endPeriod ?></td>
            <?php else: ?>
            <td data-colIndex="4" style="display: none"><?= $startPeriod . '-' . $endPeriod ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][5] == 1): ?>
            <td data-colIndex="5"><?= $val['segment'] ?></td>
            <?php else: ?>
            <td data-colIndex="5" style="display: none"><?= $val['segment'] ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][6] == 1): ?>
            <td data-colIndex="6"><?= $val['frs'] ?></td>
            <?php else: ?>
            <td data-colIndex="6" style="display: none"><?= $val['frs'] ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][7] == 1): ?>
            <td data-colIndex="7"><?= \php\classes\models\AneeModel::getSupplierName($val['frs']) ?></td>
            <?php else: ?>
            <td data-colIndex="7" style="display: none"><?= \php\classes\models\AneeModel::getSupplierName($val['frs']) ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][8] == 1): ?>
            <td data-colIndex="8"><?= $val['article'] ?></td>
            <?php else: ?>
            <td data-colIndex="8" style="display: none"><?= $val['article'] ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][9] == 1): ?>
            <?php if($val['super_ind'] == 1): ?>
            <td data-colIndex="9"><?= $val['type_promo'] . ' - super' ?></td>
            <?php else: ?>
            <td data-colIndex="9"><?= $val['type_promo'] ?></td>
            <?php endif; ?>
            <?php else: ?>
            <?php if($val['super_ind'] == 1): ?>
              <td data-colIndex="9" style="display: none"><?= $val['type_promo'] . ' - super' ?></td>
            <?php else: ?>
              <td data-colIndex="9" style="display: none"><?= $val['type_promo'] ?></td>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][10] == 1): ?>
            <td data-colIndex="10"><?= $val['comments'] ?></td>
            <?php else: ?>
            <td data-colIndex="10" style="display: none"><?= $val['comments'] ?></td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][11] == 1): ?>
            <td class="mark-total" data-colIndex="11" data-numrow="<?= $val['id'] ?>">0</td>
            <?php else: ?>
            <td class="mark-total" data-colIndex="11" style="display: none" data-numrow="<?= $val['id'] ?>">0</td>
            <?php endif; ?>

            <?php if(!isset($_SESSION['colFilter']) || $_SESSION['colFilter'][11] == 1): ?>
            <td class="mark-tarif" data-colIndex="12" id="cost"><?= $val['billing_cost_per_service'] ?></td>
            <?php else: ?>
            <td class="mark-tarif" data-colIndex="12" id="cost" style="display: none"><?= $val['billing_cost_per_service'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_001'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_001_confirmed'] >= "0") {
                echo $val['mag_001'] . '/' . $val['mag_001_confirmed'];
              } else {
                echo $val['mag_001'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="001" data-id="<?= $val['id'] ?>"></i>
            </td>
            <?php else: ?>
            <td><?= $val['mag_001'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_003'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_003_confirmed'] >= "0") {
                echo $val['mag_003'] . '/' . $val['mag_003_confirmed'];
              } else {
                echo $val['mag_003'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="003" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_003'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_007'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_007_confirmed'] >= "0") {
                echo $val['mag_007'] . '/' . $val['mag_007_confirmed'];
              } else {
                echo $val['mag_007'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="007" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_007'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_009'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_009_confirmed'] >= "0") {
                echo $val['mag_009'] . '/' . $val['mag_009_confirmed'];
              } else {
                echo $val['mag_009'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="009" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_009'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_010'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_010_confirmed'] >= "0") {
                echo $val['mag_010'] . '/' . $val['mag_010_confirmed'];
              } else {
                echo $val['mag_010'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="010" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_010'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_011'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_011_confirmed'] >= "0") {
                echo $val['mag_011'] . '/' . $val['mag_011_confirmed'];
              } else {
                echo $val['mag_011'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="011" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_011'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_012'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_012_confirmed'] >= "0") {
                echo $val['mag_012'] . '/' . $val['mag_012_confirmed'];
              } else {
                echo $val['mag_012'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="012" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_012'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_014'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_014_confirmed'] >= "0") {
                echo $val['mag_014'] . '/' . $val['mag_014_confirmed'];
              } else {
                echo $val['mag_014'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="014" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_014'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_015'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_015_confirmed'] >= "0") {
                echo $val['mag_015'] . '/' . $val['mag_015_confirmed'];
              } else {
                echo $val['mag_015'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="015" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_015'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_016'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_016_confirmed'] >= "0") {
                echo $val['mag_016'] . '/' . $val['mag_016_confirmed'];
              } else {
                echo $val['mag_016'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="016" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_016'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_018'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_018_confirmed'] >= "0") {
                echo $val['mag_018'] . '/' . $val['mag_018_confirmed'];
              } else {
                echo $val['mag_018'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="018" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_018'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_020'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_020_confirmed'] >= "0") {
                echo $val['mag_020'] . '/' . $val['mag_020_confirmed'];
              } else {
                echo $val['mag_020'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="020" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_020'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_022'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_022_confirmed'] >= "0") {
                echo $val['mag_022'] . '/' . $val['mag_022_confirmed'];
              } else {
                echo $val['mag_022'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="022" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_022'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_023'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_023_confirmed'] >= "0") {
                echo $val['mag_023'] . '/' . $val['mag_023_confirmed'];
              } else {
                echo $val['mag_023'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="023" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_023'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_024'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_024_confirmed'] >= "0") {
                echo $val['mag_024'] . '/' . $val['mag_024_confirmed'];
              } else {
                echo $val['mag_024'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="024" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_024'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_025'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_025_confirmed'] >= "0") {
                echo $val['mag_025'] . '/' . $val['mag_025_confirmed'];
              } else {
                echo $val['mag_025'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="025" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_025'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_026'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_026_confirmed'] >= "0") {
                echo $val['mag_026'] . '/' . $val['mag_026_confirmed'];
              } else {
                echo $val['mag_026'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="026" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_026'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_027'] == 0 && $val['super_ind'] == 1 || $val['comments'] == 'TP'): ?>
            <td><?php
              if($val['mag_027_confirmed'] >= "0") {
                echo $val['mag_027'] . '/' . $val['mag_027_confirmed'];
              } else {
                echo $val['mag_027'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="027" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_027'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_028'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_028_confirmed'] >= "0") {
                echo $val['mag_028'] . '/' . $val['mag_028_confirmed'];
              } else {
                echo $val['mag_028'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="028" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_028'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_029'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_029_confirmed'] >= "0") {
                echo $val['mag_029'] . '/' . $val['mag_029_confirmed'];
              } else {
                echo $val['mag_029'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="029" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_029'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_030'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_030_confirmed'] >= "0") {
                echo $val['mag_030'] . '/' . $val['mag_030_confirmed'];
              } else {
                echo $val['mag_030'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="030" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_030'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_031'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_031_confirmed'] >= "0") {
                echo $val['mag_031'] . '/' . $val['mag_031_confirmed'];
              } else {
                echo $val['mag_031'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="031" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_031'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_032'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_032_confirmed'] >= "0") {
                echo $val['mag_032'] . '/' . $val['mag_032_confirmed'];
              } else {
                echo $val['mag_032'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="032" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_032'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_033'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_033_confirmed'] >= "0") {
                echo $val['mag_033'] . '/' . $val['mag_033_confirmed'];
              } else {
                echo $val['mag_033'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="033" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_033'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_034'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_034_confirmed'] >= "0") {
                echo $val['mag_034'] . '/' . $val['mag_034_confirmed'];
              } else {
                echo $val['mag_034'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="034" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_034'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_035'] == 0 && $val['super_ind'] != 1 || $val['comments'] == 'TP' && $val['super_ind'] != 1): ?>
            <td><?php
              if($val['mag_035_confirmed'] >= "0") {
                echo $val['mag_035'] . '/' . $val['mag_035_confirmed'];
              } else {
                echo $val['mag_035'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="035" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_035'] ?></td>
            <?php endif; ?>

            <?php if($val['mag_037'] == 0 && $val['super_ind'] == 1 || $val['comments'] == 'TP'): ?>
            <td><?php
              if($val['mag_037_confirmed'] >= "0") {
                echo $val['mag_037'] . '/' . $val['mag_037_confirmed'];
              } else {
                echo $val['mag_037'];
              }
              ?> <i class="far fa-edit edit-cost" data-store="037" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_037'] ?></td>
            <?php endif; ?>
          </tr>
        <?php
        endforeach;
        ?>
        </tbody>
      <?php
      endif;
      ?>

    </table>
  </div>
</section>

<!--MODAL-->
<div class="modalTarif">
  <span class="modalTarif--close">x</span>
  <h2 class="modalTarif__header">Изменение тарифа</h2>
  <div class="modalTarif__body">
    <form action="" class="tarif-form">
      <select class="tarif-form__select">
        <option id="curentCost">0</option>
        <option id="newCost"></option>
      </select>
      <button class="tarif-form__button">Подтвердить</button>
    </form>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary editTableBtn" data-toggle="modal" data-target="#exampleModalCenter">
  Редактировать столбцы таблицы
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Управление столбцами таблицы</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="control-block">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="colFilterSave">Созранить</button>
      </div>
    </div>
  </div>
</div>