<template>
  <vs-row>
      <vs-card>
          <div class="centerx labelx">
              <h3>Редактирование записи автомобиля:</h3>
              <b-container>
                <b-form ref="v-form">
                    <b-form-row>

                        <b-col>
                            <b-form-group  label="Название модели:" label-for="input-1">
                                <b-form-input id="input-1" v-model="form.name" type="text" required  />
                            </b-form-group>
                        </b-col>
                        <b-col>
                            <b-form-group  label="Год выпуска:" label-for="input-2">
                                <b-form-input id="input-2" v-model="form.pub_year" type="text" required />
                            </b-form-group>
                        </b-col>

                    </b-form-row>

                    <b-form-row>

                        <b-col>
                            <b-form-group  label="Номер двигателя:" label-for="input-1">
                                <b-form-input id="input-1" v-model="form.engine_number" type="text" required  />
                            </b-form-group>
                        </b-col>

                        <b-col>
                            <b-form-group  label="Объем двигателя (в куб. см)" label-for="input-3">
                                <b-form-input id="input-3" v-model="form.engine_volume" type="text" required />
                            </b-form-group>
                        </b-col>

                    </b-form-row>

                    <b-form-group  label="Цвет (Список):" label-for="input-2">
                        <v-select :selected='null' v-model='form.colors' :reduce="color => color.id" label='name' :multiple=true v-bind:options="color_options"></v-select>
                    </b-form-group>

                    <b-form-group  label="Описание" label-for="input-3">
                        <b-form-textarea
                        id="textarea"
                        v-model="form.description"
                        rows="3"
                        max-rows="6"
                        ></b-form-textarea>
                    </b-form-group>

                    <vs-divider />

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Фото:</label>
                        <input ref='image' type="file" class="image" v-on:change="onFileChange" id="exampleFormControlFile1">
                    </div>

                    <vs-divider />
                    <vs-button color="primary" type="filled" v-on:click="submit">Создать</vs-button>
                    <b-alert v-if="show_sucess" variant="success" show>Запись успешно сохранена!</b-alert>

                    <vs-button color="primary" type="filled" v-on:click="submit">Редактировать</vs-button>
                </b-form>
              </b-container>


          </div>
      </vs-card>
  </vs-row>
</template>

<script>
export default {
    data() {

        var form_fields = {
            name: "",
            pub_year: "",
            engine_volume: "",
            engine_number: "",
            image: "",
            description: "",
            colors: []
        };
        return {
            'form': form_fields,
            'color_options' : [],
            'show_sucess' : false
        }
    },
    methods: {
        async loadCar() {
            this.$vs.loading();
            let id = this.$route.params.id;
            let res = await axios.get(`/api/cars/${id}`);
            let car = res.data;
            this.form = car;
            this.$vs.loading.close();
        },
        submit() {
            var form_data = new FormData();

            for(var field in this.form){
                form_data.set(field,this.form[field]);
            }

            axios({
                method: 'post',
                url: `/api/cars/edit/${this.$route.params.id}`,
                data: form_data,
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((response) => {
                console.log(response);
                this.loadColors();
                this.loadCar();
                this.show_sucess = true;
            })
        },
        onFileChange(e) {
            e.preventDefault();
            var file = this.$refs['image'].files[0];
            this.form.image = file;
        },

    },
    mounted() {
        this.loadColors();
    }
}
</script>

<style>
  .labelx .vs-input{
      margin: 15px;
  }
</style>
