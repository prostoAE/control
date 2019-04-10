<!--FILTER-->
<section class="filters">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h2 class="form-header">Фильтры отчета</h2>
      </div>
    </div>
    <div class="row">
      <?php
//      require_once 'php/supTableLoad.php';
      ?>
      <form class="filter-form" method="post">
        <div class="form-row">
          <label>
            <select name="buyer">
              <option style="display: none" selected>BUYER</option>
              <?php foreach ($buyers as $value): ?>
                <option><?= $value['BUYER'] ?></option>
              <?php endforeach; ?>
            </select>
          </label>
          <label>
            <select name="group">
              <option style="display: none" selected>GROUP</option>
              <?php foreach ($groups as $value): ?>
                <option><?= $value['GROUPE'] ?></option>
              <?php endforeach; ?>
            </select>
          </label>
          <label>
            <input name="date-from" type="text" placeholder="Дата с:" onfocus="(this.type='date')" onblur="(this.type='text')" required value="2019.03.01">
          </label>
          <label>
            <input name="date-to" type="text" placeholder="Дата по:" onfocus="(this.type='date')" onblur="(this.type='text')" required value="2019.03.31">
          </label>
        </div>
        <div class="form-row">
          <label>
            <input name="supplier" type="text" placeholder="supplier">
          </label>
          <label>
            <input name="article" type="text" placeholder="article">
          </label>
          <button name="submit" type="submit">Применить<i class="fas fa-filter"></i></button>
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
        <tr>
          <th>start_date</th>
          <th>end_date</th>
          <th>buyer</th>
          <th>short_condition</th>
          <th>n_agreement</th>
          <th>segment</th>
          <th>frs</th>
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
        <?php
        foreach ($table as $val):
          ?>
          <tr>
            <td><?= $val['start_date'] ?></td>
            <td><?= $val['end_date'] ?></td>
            <td><?= $val['buyer'] ?></td>
            <td><?= $val['short_condition'] ?></td>
            <td><?= $val['n_agreement'] ?></td>
            <td><?= $val['segment'] ?></td>
            <td><?= $val['frs'] ?></td>
            <td><?= $val['article'] ?></td>
            <td><?= $val['type_promo'] ?></td>
            <td><?= $val['comments'] ?></td>
            <td><?= $val['billing_cost_per_service'] ?><i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <td><?= $val['mag_001'] ?></td>
            <td><?= $val['mag_003'] ?></td>
            <td><?= $val['mag_007'] ?></td>
            <td><?= $val['mag_009'] ?></td>
            <td><?= $val['mag_010'] ?></td>
            <td><?= $val['mag_011'] ?></td>
            <td><?= $val['mag_012'] ?></td>
            <td><?= $val['mag_014'] ?></td>
            <td><?= $val['mag_015'] ?></td>
            <td><?= $val['mag_016'] ?></td>
            <td><?= $val['mag_018'] ?></td>
            <td><?= $val['mag_020'] ?></td>
            <td><?= $val['mag_022'] ?></td>
            <td><?= $val['mag_023'] ?></td>
            <td><?= $val['mag_024'] ?></td>
            <td><?= $val['mag_025'] ?></td>
            <td><?= $val['mag_026'] ?></td>
            <td><?= $val['mag_027'] ?></td>
            <td><?= $val['mag_028'] ?></td>
            <td><?= $val['mag_029'] ?></td>
            <td><?= $val['mag_030'] ?></td>
            <td><?= $val['mag_031'] ?></td>
            <td><?= $val['mag_032'] ?></td>
            <td><?= $val['mag_033'] ?></td>
            <td><?= $val['mag_034'] ?></td>
            <td><?= $val['mag_035'] ?></td>
            <td><?= $val['mag_037'] ?></td>
          </tr>
        <?php
        endforeach;
      endif;
      ?>
    </table>
  </div>
</section>