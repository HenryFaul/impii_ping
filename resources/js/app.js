import { createApp, h } from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { VueReCaptcha, useReCaptcha } from 'vue-recaptcha-v3'
/* import the fontawesome core */

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
library.add(fas);
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  title: title => title ? `${title} - Impii` : 'Impii',
  setup({ el, App, props, plugin }) {

    const captcheKey = props.initialPage.props.recaptcha_site_key;
    createApp({ render: () => h(App, props) })
      .use(plugin).component('FontAwesomeIcon',FontAwesomeIcon)
      .use(VueReCaptcha, { siteKey: captcheKey } )
      .use(useReCaptcha)
      .mount(el)
  },
})
