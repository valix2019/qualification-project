import Vue from 'vue';
import {
  ValidationObserver,
  ValidationProvider,
  extend,
  localize
} from 'vee-validate'
import ru from 'vee-validate/dist/locale/ru.json'
// import en from 'vee-validate/dist/locale/en.json'
import * as rules from 'vee-validate/dist/rules'

// Install VeeValidate rules and localization
Object.keys(rules).forEach(rule => {
  extend(rule, rules[rule])
})

localize('ru', ru)

Vue.component('ValidationProvider', ValidationObserver)
Vue.component('ValidationProvider', ValidationProvider)
