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
      $anee = new \php\classes\models\AneeModel();
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
          <th>frs< name/th>
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
            <td><?= $anee->getSupplierName($val['frs']) ?></td>
            <td><?= $val['article'] ?></td>
            <td><?= $val['type_promo'] ?></td>
            <td><?= $val['comments'] ?></td>
            <td><?= $val['billing_cost_per_service'] ?></td>
            <?php if($val['mag_001'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_001'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_001'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_003'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_003'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_003'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_007'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_007'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_007'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_009'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_009'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_009'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_010'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_010'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_010'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_011'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_011'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_011'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_012'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_012'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_012'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_014'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_014'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_014'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_015'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_015'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_015'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_016'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_016'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_016'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_018'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_018'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_018'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_020'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_020'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_020'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_022'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_022'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_022'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_023'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_023'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_023'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_024'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_024'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_024'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_025'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_025'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_025'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_026'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_026'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_026'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_027'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_027'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_027'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_028'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_028'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_028'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_029'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_029'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_029'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_030'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_030'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_030'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_031'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_031'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_031'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_032'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_032'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_032'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_033'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_033'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_033'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_034'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_034'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_034'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_035'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_035'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_035'] ?></td>
            <?php endif; ?>
            <?php if($val['mag_037'] == 0 || $val['comments'] == 'TP'): ?>
            <td><?= $val['mag_037'] ?> <i class="far fa-edit edit-cost" data-id="<?= $val['id'] ?>"></i></td>
            <?php else: ?>
            <td><?= $val['mag_037'] ?></td>
            <?php endif; ?>
          </tr>
        <?php
        endforeach;
      endif;
      ?>
    </table>
  </div>
</section>

