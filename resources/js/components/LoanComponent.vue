<template>
  <div class="card">
    <div class="card-header">Resgitro de prestamos</div>

    <div class="card-body">
      <form enctype="multipart/form-data">
        <div class="form-group">
           <datepicker v-model="state.date"
            inputFormat="dd-MM-yyyy" :weekStartsOn=startAt :local="local"/>
            <span v-if="v$.date.$error">
                {{ v$.date.$errors[0].$message }}
              </span>              
        </div>

        <div class="card-body">
          <div class="row">
               <Multiselect
                v-model="state.user"
                placeholder="Cliente"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="cliente"
              />
              <span v-if="v$.user.$error">
                {{ v$.user.$errors[0].$message }}
              </span>
          </div>
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
import { ref } from 'vue'
import { required } from "@vuelidate/validators";
import { reactive, computed } from "vue";
import Multiselect from "@vueform/multiselect";
import Datepicker from 'vue3-datepicker'
import { es } from 'date-fns/locale'

export default {
  components: {
    Multiselect,
    Datepicker,
  },
  data() {
    return {
      startAt: 0,
      routes: [
        { value: "1", label: "ruta 1" },
        { value: "2", label: "ruta 2" },
        { value: "3", label: "ruta 3" },
      ],
      cliente: [
        { value: "1", label: "cliente 1", comerce:"comercio1", id:"1-1111-111" },
        { value: "2", label: "ruta 2", comerce:"comercio2", id:"2-1111-111" },
        { value: "3", label: "ruta 3", comerce:"comercio3", id:"3-1111-111" },
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
      date: ref(new Date()),
      user: "",
      amount: "",
      plazo: "",
      interes: "",
      periodo: "",
      metodo: "",
      montoInteres: "",
      couta: "",
      cantidadCoutas: "",
      coutaFInal: "",
      fechaFin: ""
    });

    const rules = computed(() => {
      return {
        date: { required },
        user: { required },
        amount: { required },
        plazo: { required },
        interes: { required },
        periodo: { required },
        metodo: { required },
        montoInteres: { required },
        couta: { required },
        cantidadCoutas: { required },
        coutaFInal: { required },
        fechaFin: { required },
      };
    });
    const  local = ref(es);
    const v$ = useValidate(rules, state);

    return {
      local,
      state,
      v$,
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

