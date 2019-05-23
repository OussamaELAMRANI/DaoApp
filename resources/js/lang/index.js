import Vue from 'vue';
import VueI18n from 'vue-i18n';
import Cookies from 'js-cookie'

import arLang from './ar'
import frLang from './fr'

Vue.use(VueI18n);


const messages = {
    fr: {
        ...frLang
    },
    ar: {
        ...arLang
    }
}

export function getLanguage() {
    const chooseLanguage = Cookies.get('language');

    if (chooseLanguage) {
        return chooseLanguage;
    }

    // if has not choose language
    const language = (navigator.language || navigator.browserLanguage).toLowerCase();
    const locales = Object.keys(messages);
    for (const locale of locales) {
        if (language.indexOf(locale) > -1) {
            return locale;
        }
    }
    return 'fr';
}
const i18n = new VueI18n({
    // set locale
    // options: fr || ar
    locale: getLanguage(),
    // set locale messages
    messages,
});

export default i18n;

