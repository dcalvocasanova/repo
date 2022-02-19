<template>
  <div class="form-group">
    <h2>Create an Account</h2>
    <p>
      <input
        type="text"
        class="form-control col-4"
        placeholder="Email"
        v-model="state.email"
      />
      <span v-if="v$.email.$error">
        {{ v$.email.$errors[0].$message }}
      </span>
    </p>
    <p>
      <input
        type="password"
        placeholder="Password"
        v-model="state.password.password"
      />
      <span v-if="v$.password.password.$error">
        {{ v$.password.password.$errors[0].$message }}
      </span>
    </p>
    <p>
      <input
        type="password"
        placeholder="Confirm Password"
        v-model="state.password.confirm"
      />
      <span v-if="v$.password.confirm.$error">
        {{ v$.password.confirm.$errors[0].$message }}
      </span>
    </p>

    
 <div  class="col-4">
    <Multiselect
        v-model="value"
        :close-on-select="true"
        :searchable="true"
        :create-option="true"
        :options="[
            { value: 'batman', label: 'Batman' },
            { value: 'robin', label: 'Robin' },
            { value: 'joker', label: 'Joker' },
        ]"
    />
 </div>

 <br>
 <br>

    <button class="btn btn-xs btn-primary" @click="submitForm">Submit</button>


  </div>
</template>

<script>
import useValidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import { reactive, computed } from "vue";
import Multiselect from "@vueform/multiselect";

export default {
  components: {
    Multiselect,
  },
  data() {
      return {
          options: ['a', 'b' , 'c' ]
      }
  },
  setup() {
    const state = reactive({
      name: "",
      alias: "",
      id="",
      company:"",
      phone1:"",
      phone2:"",
      email:"",
      address:"",
      home:"",
      gps:"",
      status:"",
      route:"",
      collector:"",
      photo:"",
      
    });

    const rules = computed(() => {
      return {
        email: { required },
        password: {
          password: { required },
          confirm: { required },
        },
      };
    });

    const v$ = useValidate(rules, state);

    return { state, v$ };
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
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

