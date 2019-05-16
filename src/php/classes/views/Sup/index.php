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
            <input id="from" name="date-from" type="text" placeholder="Дата с:" onfocus="(this.type='date')" onblur="(this.type='text')" required value="<?= date("Y.m.01") ?>">
          </label>
          <label>
            <input id="to" name="date-to" type="text" placeholder="Дата по:" onfocus="(this.type='date')" onblur="(this.type='text')" required value="<?= date("Y.m.d") ?>">
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
    <table>
      <?php if($table): ?>
      <thead>
        <tr>
          <th>start_date</th>
          <th>end_date</th>
          <th>buyer</th>
          <th>short_condition</th>
          <th>n_agreement</th>
          <th>segment</th>
          <th>frs</th>
          <th>frs name</th>
          <th>article</th>
          <th>type_promo</th>
          <th>comments</th>
          <th>billing_cost_per_service</th>
          <th>mag_001</th>
          <th>mag_003</th>
          <th>mag_007</th>
          <th>mag_009</th>
          <th>mag_010</th>
          <th>mag_011</th>
          <th>mag_012</th>
          <th>mag_014</th>
          <th>mag_015</th>
          <th>mag_016</th>
          <th>mag_018</th>
          <th>mag_020</th>
          <th>mag_022</th>
          <th>mag_023</th>
          <th>mag_024</th>
          <th>mag_025</th>
          <th>mag_026</th>
          <th>mag_027</th>
          <th>mag_028</th>
          <th>mag_029</th>
          <th>mag_030</th>
          <th>mag_031</th>
          <th>mag_032</th>
          <th>mag_033</th>
          <th>mag_034</th>
          <th>mag_035</th>
          <th>mag_037</th>
        </tr>
      </thead>
        <?php
        foreach ($table as $val):
          ?>
        <tbody>
          <tr>
            <td class="dateFrom"><?= date("d.m.Y", strtotime($val['start_date'])) ?></td>
            <td class="dateTo"><?= date("d.m.Y", strtotime($val['end_date'])) ?></td>
            <td><?= $val['buyer'] ?></td>
            <td><?= $val['short_condition'] ?></td>
            <td><?= $val['n_agreement'] ?></td>
            <td><?= $val['segment'] ?></td>
            <td><?= $val['frs'] ?></td>
            <td><?= \php\classes\models\AneeModel::getSupplierName($val['frs']) ?></td>
            <td><?= $val['article'] ?></td>
            <?php if($val['super_ind'] == 1): ?>
            <td><?= $val['type_promo'] . ' - super' ?></td>
            <?php else: ?>
            <td><?= $val['type_promo'] ?></td>
            <?php endif; ?>
            <td><?= $val['comments'] ?></td>
            <td id="cost"><?= $val['billing_cost_per_service'] ?></td>

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
        </tbody>
        <?php
        endforeach;
      endif;
      ?>
    </table>
  </div>
</section>

<!--MODAL-->
<div class="modal">
  <span class="modal--close">x</span>
  <h2 class="modal__header">Изменение тарифа</h2>
  <div class="modal__body">
    <form action="" class="tarif-form">
      <select class="tarif-form__select">
        <option id="curentCost">0</option>
        <option id="newCost"></option>
      </select>
      <button class="tarif-form__button">Подтвердить</button>
    </form>
  </div>
</div>
