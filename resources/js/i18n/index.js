import Vue from "vue";
import VueI18n from "vue-i18n";

Vue.use(VueI18n);

const locale = localStorage.getItem('preselected_locale') ?? process.env.MIX_APP_DEFAULT_LOCALE

export default new VueI18n({
    locale: locale,
});