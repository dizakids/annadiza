import Vue from 'vue'
import Vuetify, {
    VApp, // required
    VNavigationDrawer,
    VFooter,
    VToolbar,
    VTextField
} from 'vuetify/lib'
import {Ripple} from 'vuetify/lib/directives'

Vue.use(Vuetify, {
    components: {
        VApp,
        VNavigationDrawer,
        VFooter,
        VToolbar,
        VTextField
    },
    directives: {
        Ripple
    }
})
