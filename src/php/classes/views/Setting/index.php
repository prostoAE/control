<div class="loader-bg">
  <div class="loader"></div>
</div>

<!-- Grid container -->
<div class="container">
  <h3 class="text-center setting-header">Настройки</h3>
  <section class="settings">
    <div class="row">

      <div class="col-lg-3">
        <div class="settings__link">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Пользователи</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Загрузки</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Общие настройки</a>
          </div>
        </div>
      </div>

      <div class="col-lg-9">
        <div class="settings__content">
          <div class="tab-content" id="v-pills-tabContent">

            <!--First pill-->
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              <h2 class="settings__content-header">Управление пользователями</h2>
              <table class="table table-striped">
                <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
                </tbody>
              </table>
            </div>

            <!--Second pill-->
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
              <h2 class="settings__content-header">Настройки SUP</h2>

              <div class="setting-block">
                <form action="" class="form" method="post" id="agrYearForm">
                  <label>Установка года агримента
                    <select name="agrYear">
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                    </select>
                  </label>
                <button id="agrYearBtn">Save</button>
                </form>
              </div>
              <hr>

              <div class="setting-block">
                <form action="" class="form" method="post" id="ccaUpdateForm">
                  <label>Обновление связки поставщик-сегмент-закупщик (CCA)
                    <select name="agrYear">
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                    </select>
                  </label>
                  <button id="ccaUpdateBtn">Save</button>
                </form>
              </div>
              <hr>

              <div class="setting-block">
                <form action="" class="form" method="post" id="serviceUpdateForm">
                  <label>Обновление услуг и тарифов Promo
                    <select name="agrYear">
                      <option value="2019">2019</option>
                      <option value="2019">2020</option>
                      <option value="2019">2021</option>
                      <option value="2019">2022</option>
                    </select>
                  </label>
                  <button id="serviceUpdateBtn">Save</button>
                </div>
              </form>
              <hr>

              <div class="setting-block">
                <h3 class="setting-block__header">Загрузить даные из SUP</h3>
                <form action="" class="form" method="post" id="supLoadForm">
                  <label>
                    <input name="date-from" type="text" placeholder="Дата с:" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                  </label>
                  <label>
                    <input name="date-to" type="text" placeholder="Дата по:" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                  </label>
                  <button id="supLoadBtn" name="submit">Загрузить</button>
                </form>
              </div>
              <hr>

              <div class="setting-block">
                <h3 class="setting-block__header">Установить период редактирования данных</h3>
                <label>
                  <input name="date-from" type="text" placeholder="Дата с:" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                </label>
                <label>
                  <input name="date-to" type="text" placeholder="Дата по:" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                </label>
                <button>Установить</button>
              </div>
              <hr>

            </div>

            <!--Third tab-->
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- Grid container -->
