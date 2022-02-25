<template>
  <div class="card">
    <div class="card-header">Resgitro de prestamos</div>

    <div class="card-body">
      <form enctype="multipart/form-data">
        <div class="form-group">
          <datepicker
            v-model="state.date"
            locale="es"
            weekStart="0"
            placeholder="Selecione fecha"
            :format="format"
            autoApply
          ></datepicker>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-4">
              <Multiselect
                v-model="state.user"
                placeholder="Cliente"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="cliente"
              />
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-3">
              <input
                type="number"
                class="form-control col-12"
                placeholder="Monto"
                v-model="state.amount"
              />
            </div>
            <div class="col-2">
              <Multiselect
                v-model="state.plazo"
                placeholder="Plazo"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="plazo"
              />
            </div>
            <div class="col-2">
              <Multiselect
                v-model="state.interes"
                placeholder="Interés"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="interes"
              />
            </div>

            <div class="col-2">
              <Multiselect
                v-model="state.periodo"
                placeholder="Periodo"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="periodo"
              />
            </div>

            <div class="col-2">
              <Multiselect
                v-model="state.metodo"
                placeholder="Método"
                :close-on-select="true"
                :searchable="true"
                :create-option="true"
                :options="metodo"
              />
            </div>
          </div>
        </div>

        <br />
        <br />

        <div class="form-group">
          <div class="row">
            <div class="col-3">
              <label for="int"> Interés a pagar</label>
              <input
                type="number"
                class="form-control col-12"
                placeholder="Monto de intereses"
                name="int"
                v-model="state.montoInteres"
                readonly
              />
            </div>

            <div class="col-3">
              <label for="couta"> Couta a pagar)</label>
              <input
                type="number"
                class="form-control col-12"
                placeholder="Couta"
                name="couta"
                v-model="state.couta"
              />
            </div>

            <div class="col-3">
              <label for="coutaf"> Couta final</label>
              <input
                type="number"
                class="form-control col-12"
                placeholder="Couta"
                name="coutaf"
                v-model="state.coutaFinal"
              />
            </div>

            <div class="col-3">
              <label for="coutac"> Cantidad de coutas</label>
              <input
                type="number"
                class="form-control col-12"
                placeholder="Couta"
                name="coutac"
                v-model="state.cantidadCoutas"
                readonly
              />
            </div>
          </div>
        </div>

        <br />
        <br />

        <button class="btn btn-primary" @click.prevent="submitForm">
          Guardar
        </button>
      </form>



      <br><br>

      <div class="table-responsive">
        <table class=" table table-bordered table-striped table-hover datatable datatable-LoanApplication">
          <thead>
            <tr>
              <th># Couta</th>
              <th>Fecha </th>
              <th> Couta</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

      </div>
    </div>
  </div>
</template>

<script>
import useValidate from "@vuelidate/core";
import { integer, required } from "@vuelidate/validators";
import { reactive, ref, computed, watchEffect } from "vue";
import Multiselect from "@vueform/multiselect";
import Datepicker from "vue3-date-time-picker";
import Form from "vform";
import {
  Button,
  HasError,
  AlertError,
  AlertErrors,
  AlertSuccess,
} from "vform/src/components/bootstrap5";

export default {
  components: {
    Multiselect,
    Datepicker,
    HasError,
    Form,
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
        {
          value: "1",
          label: "cliente 1",
          comerce: "comercio1",
          id: "1-1111-111",
        },
        {
          value: "2",
          label: "cliente 2",
          comerce: "comercio2",
          id: "2-1111-111",
        },
        {
          value: "3",
          label: "cliente 3",
          comerce: "comercio3",
          id: "3-1111-111",
        },
      ],
      collectors: [
        { value: "1", label: "cobrador 1" },
        { value: "2", label: "cobrador 2" },
        { value: "3", label: "cobrador 3" },
      ],

      plazo: [
        { value: "15", label: "15 " },
        { value: "30", label: "30 " },
        { value: "40", label: "40 " },
        { value: "45", label: "45 " },
        { value: "60", label: "60 " },
        { value: "90", label: "90 " },
      ],

      interes: [
        { value: "10", label: "10" },
        { value: "15", label: "15" },
        { value: "20", label: "20" },
        { value: "25", label: "25" },
        { value: "30", label: "30" },
      ],

      periodo: [
        { value: "1", label: "periodo 1" },
        { value: "2", label: "periodo 2" },
        { value: "3", label: "periodo 3" },
        { value: "7", label: "periodo 7" },
        { value: "15", label: "periodo 15" },
        { value: "30", label: "periodo 30" },
      ],

      metodo: [
        { value: "1", label: "Efectivo" },
        { value: "2", label: "Sinpe" },
        { value: "3", label: "Transferencia" },
        { value: "4", label: "Otros" },
      ],
    };
  },

  setup() {
    const calcs = reactive({
      montoPagar: 0,
      couta: 0,
      cotaFinal: 0,
      cantCoutas: 0,
      parteEntera: 0,
    });

    const state = reactive({
      date: ref(new Date()),
      user: "",
      amount: integer,
      plazo: 0,
      interes: 0,
      periodo: 0,
      metodo: 0,
      montoInteres: 0,
      couta: 0,
      cantidadCoutas: 0,
      coutaFinal: 0,
      fechaFin: "",
      montoTotal: integer,
      coutasModificadas: integer,
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
        coutaFinal: { required },
        fechaFin: { required },
      };
    });

    const v$ = useValidate(rules, state);

    const format = (date) => {
      let day = date.getDate();
      let month = date.getMonth() + 1;
      let year = date.getFullYear();

      if (day < 10){
        day='0'+ day;
      }
      if (month < 10){
        month='0'+ month;
      }

      return `${day}/${month}/${year}`;
    };

    watchEffect(() => {
      if (parseInt(state.amount) > 0 && parseInt(state.interes) > 0) {
        state.montoInteres =
          (parseInt(state.amount) * parseInt(state.interes)) / 100;
      }

      if (parseInt(state.montoInteres) > 0) {
        if (parseInt(state.plazo) > 0 && parseInt(state.periodo) > 0) {
            state.montoTotal =
              parseInt(state.montoInteres) + parseInt(state.amount);
            state.cantidadCoutas = Math.ceil(
              parseInt(state.plazo) / parseInt(state.periodo)
            );

            if (state.cantidadCoutas > 1)
            {
              let posiblecouta = Math.ceil(
              parseInt(state.montoTotal) / parseInt(state.cantidadCoutas)
            );

            let calculoCouta = posiblecouta.toString();

            state.coutaFinal = posiblecouta;
            let ceros = 1;

            for (let i = 1; i < calculoCouta.length; i++) {
              ceros *= 10;
            }
            let CalculoCerrado = parseInt(calculoCouta.slice(0, 2));
            state.couta = Math.ceil(CalculoCerrado / 10) * ceros;

            state.cantidadCoutas = Math.ceil(
              parseInt(state.montoTotal) / parseInt(state.couta)
            );

            let calculoUltimaCouta =
              parseInt(state.montoTotal) -
              parseInt(state.couta) * parseInt(state.cantidadCoutas);

            if (calculoUltimaCouta > 0) 
            {
              state.coutaFinal = calculoUltimaCouta;
              state.coutasModificadas = parseInt(state.cantidadCoutas);
            } else 
            {
              state.coutaFinal =
                parseInt(state.montoTotal) -
                parseInt(state.couta) * (parseInt(state.cantidadCoutas) - 1);
              state.coutasModificadas = parseInt(state.cantidadCoutas) - 1;
            }

          }else 
          {
            state.coutaFinal = 0
            state.couta = state.montoTotal
              
          }

          
        }
      }
    });

    return {
      state,
      v$,
      calcs,
      format,
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

    getLoan() {
      this.form.montoInteres =
        (parseInt(this.form.amount) * parseInt(this.form.interes)) / 100;
      this.calcs.montoPagar =
        parseInt(this.form.amount) * parseInt(this.montoInteres);
      let cantidad = this.calcs.montoPagar.toString();
      let ceros = 1;

      for (let i = 1; i < cantidad.length - 1; i++) {
        ceros *= 10;
      }

      let preCalculoParteEntera = parseInt(cantidad.slice(0, 2));
      this.form.couta = Math.ceil(preCalculoParteEntera / 10) * ceros;
      this.form.cantCoutas = Math.floor(
        parseInt(this.calcs.montoPagar) / parseInt(this.form.couta)
      );
      this.form.coutaFinal =
        parseInt(this.calcs.montoPagar) -
        parseInt(this.form.couta) * parseInt(this.form.cantCoutas);
    },
  },
};
</script>

<style scoped>
@import "vue3-date-time-picker/dist/main.css";
</style>

