<template>
  <div class="card">
    <div class="card-header">Resgitro de cliente</div>

    <div class="card-body">
      <form enctype="multipart/form-data">
        <div class="form-group">
          <input
            type="text"
            class="form-control col-12"
            placeholder="Nombre"
            v-model="state.name"
          />
          <span v-if="v$.name.$error">
            {{ v$.name.$errors[0].$message }}
          </span>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Alias"
                v-model="state.alias"
              />
              <span v-if="v$.alias.$error">
                {{ v$.alias.$errors[0].$message }}
              </span>
            </div>

            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Cédula"
                v-model="state.id"
              />
              <span v-if="v$.id.$error">
                {{ v$.id.$errors[0].$message }}
              </span>
            </div>

            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Empresa"
                v-model="state.company"
              />
              <span v-if="v$.company.$error">
                {{ v$.company.$errors[0].$message }}
              </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Teléfono 1"
                v-model="state.phone1"
              />
              <span v-if="v$.phone1.$error">
                {{ v$.phone1.$errors[0].$message }}
              </span>
            </div>
            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Teléfono 2"
                v-model="state.phone2"
              />
              <span v-if="v$.phone2.$error">
                {{ v$.phone2.$errors[0].$message }}
              </span>
            </div>
            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Email"
                v-model="state.email"
              />
              <span v-if="v$.email.$error">
                {{ v$.email.$errors[0].$message }}
              </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-8">
              <textarea
                class="form-control col-12"
                rows="4"
                placeholder="Dirección"
                v-model="state.address"
              ></textarea>
              <span v-if="v$.address.$error">
                {{ v$.address.$errors[0].$message }}
              </span>
            </div>
            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Casa"
                v-model="state.home"
              />
              <span v-if="v$.home.$error">
                {{ v$.home.$errors[0].$message }}
              </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <dir class="row">
            <div class="col-8">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Ubicación GPS"
                v-model="state.gps"
              />
              <span v-if="v$.gps.$error">
                {{ v$.gps.$errors[0].$message }}
              </span>
            </div>
            <div class="col-4">
              <input
                type="text"
                class="form-control col-12"
                placeholder="Estado"
                v-model="state.status"
              />
              <span v-if="v$.status.$error">
                {{ v$.status.$errors[0].$message }}
              </span>
            </div>
          </dir>
        </div>
        <div class="form-group">
          <dir class="row">
            <div class="col-4">
              <Multiselect
                v-model="state.route"
                placeholder="ruta"
                class="form-control col-12"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="routes"
              />
              <span v-if="v$.route.$error">
                {{ v$.route.$errors[0].$message }}
              </span>
            </div>
            <div class="col-4">
              <Multiselect
                v-model="state.collector"
                placeholder="Cobrador"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="collectors"
              />
              <span v-if="v$.collector.$error">
                {{ v$.collector.$errors[0].$message }}
              </span>
            </div>
            <div class="col-4">
              <p>
              <span v-html="loadedImg"></span>
              </p>

              <label for="file" style="cursor: pointer" class="btn btn-lg btn-info"> Cargar imagen</label>
                <input
                  type="file"
                  accept="image/*"
                  name="file"
                  id="file"
                  enctype="multipart/form-data"
                  @change="loadFile"
                  style="display: none"
                />
                <span v-if="v$.photo.$error">
                  {{ v$.photo.$errors[0].$message }}
                </span>                 
              
            </div>
          </dir>
        </div>

        <br />
        <br />

        <button class="btn btn-primary" @click.prevent="submitForm">
          Guardar
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import useValidate from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";
import { reactive, computed } from "vue";
import Multiselect from "@vueform/multiselect";

export default {
  components: {
    Multiselect,
  },
  data() {
    return {
      loadedImg: "",
      routes: [
        { value: "1", label: "ruta 1" },
        { value: "2", label: "ruta 2" },
        { value: "3", label: "ruta 3" },
      ],
      collectors: [
        { value: "1", label: "cobrador 1" },
        { value: "2", label: "cobrador 2" },
        { value: "3", label: "cobrador 3" },
      ],
    };
  },
  setup() {
    const state = reactive({
      name: "",
      alias: "",
      id: "",
      company: "",
      phone1: "",
      phone2: "",
      email: "",
      address: "",
      home: "",
      gps: "",
      status: "",
      route: "",
      collector: "",
      photo: "",
    });

    const rules = computed(() => {
      return {
        email: { required, email },
        name: { required },
        alias: { required },
        id: { required },
        company: { required },
        phone1: { required },
        phone2: { required },
        address: { required },
        home: { required },
        gps: { required },
        status: { required },
        route: { required },
        collector: { required },
        photo: { required },
      };
    });

    const v$ = useValidate(rules, state);

    return {
      state,
      v$,
    };
  },

  validations() {
    return {
      email: { required },
      password: {
        password: { required },
        confirm: { required },
      },
    };
  },

  methods: {
    submitForm() {
      this.v$.$validate();
      if (!this.v$.$error) {
        alert("Form successfully submitted.");
      } else {
        alert("Form failed validation");
      }
    },

    loadFile(e) {
       
       let file = e.target.files[0];
       console.log(file)
       let reader = new FileReader();
      
        
      reader.onloadend = (file) => {
          this.state.photo = reader.result;
          this.loadedImg=' <img src="'+ this.state.photo +'" style="width:60px;height:60px;" >'
      }
      reader.readAsDataURL(file);
    
      
    },
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css">
textarea {
  resize: none;
}
</style>

