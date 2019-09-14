import pkg from './package'
//const webpack = require("webpack")
const nodeExternals = require('webpack-node-externals')
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')
export default {

  mode: 'universal',

  /*
  ** Headers of the page
  */
  head: {
    title: pkg.name,
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: pkg.description }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' },
      {
        rel: "stylesheet",
        href:
          "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
      },
      {
        rel: "stylesheet",
        href:
          "https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
      },

      {
        rel: "stylesheet",
        href:
          "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css"
      },

    ],

    script: [

      {
        src: "https://code.jquery.com/jquery-3.3.1.slim.min.js",
        type: "text/javascript"
      },
      {
        src: "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
        type: "text/javascript"
      },
      {
        src: "https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js",
        type: "text/javascript"
      },
       {
        src: "~/fancybox.js",
        type: "text/javascript"
      },
       {
        src: "~/notifications.js",
        type: "text/javascript"
      },
      {
        src:
          "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js",
        type: "text/javascript"
      },
      {
        src:
          "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js",

      },

      {
        src: "https://yubinbango.github.io/yubinbango-core/yubinbango-core.js",
        charset: "UTF-8"
      },
      // {
      //   src: "https://cdn.rawgit.com/kensnyder/quill-image-resize-module/3411c9a7/image-resize.min.js",
      //   type: "text/javascript"
      // },
      // {
      //   src: "https://cdn.quilljs.com/1.2.2/quill.min.js",
      //   type: "text/javascript"
      // }
    ]
  },

  /*
  ** Customize the progress-bar color
  */
  loading: { color: 'green' },

  /*
  ** Global CSS
  */
  css: [
    '~assets/main.css',
    '~/assets/style/app.styl',
    'swiper/dist/css/swiper.css',
    'quill/dist/quill.snow.css',
    'quill/dist/quill.bubble.css',
    'quill/dist/quill.core.css',
  ],



  //   css: [
  // { src: '~assets/sass/app.scss', lang: 'scss' },

  // ],

  router: {
    middleware: [
      "clearValidationErrors",
      "tags",
    ]
  },
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    './plugins/mixins/user.js',
    './plugins/axios.js',
    './plugins/mixins/validation.js',
    { src: '~plugins/vue-awesome-swiper', ssr: false },
    { src: '~/plugins/vue-notifications', ssr: false },
    { src: '~/plugins/vuetify.js', ssr: false },

   // { src: '~plugins/nuxt-quill-plugin.js', ssr: false }
  //  { src: '~plugins/laravel-echo', ssr: false },
    //{ src: '~plugins/pusher.js', ssr: false },

  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth',
    '@nuxtjs/moment',
    // '@nuxtjs/quill-image-resize-module',
  ],

  axios: {
   baseURL: "http://127.0.0.1:8000/api"

  },

  auth: {
    strategies: {
      local: {
        endpoints: {
          login: {
            url: 'login',
            method: 'post',
            propertyName: "meta.token"
          },
          user: {
            url: 'user',
            method: 'get',
            propertyName: 'data'
          },
          logout: {
            url: 'logout',
            method: 'post'
          }
        }
      }
    }
  },
// module.exports = {
//   build: {
//     plugins: [
//       new webpack.ProvidePlugin({
//         'window.Quill': 'quill/dist/quill.js',
//         'Quill': 'quill/dist/quill.js'
//       })
//     ]
//   }
// }
  /*
  ** Build configuration
  */
  build: {
        transpile: [/^vuetify/],
    plugins: [
      new VuetifyLoaderPlugin()
    ],
    extractCSS: true,
    extend (config, ctx) {
      config.devtool = ctx.isClient ? 'eval-source-map' : 'inline-source-map'
      // Run ESLint on save
      /*if (ctx.isDev && ctx.isClient) {
        config.module.rules.push({
          enforce: 'pre',
          test: /\.(js|vue)$/,
          loader: 'eslint-loader',
          exclude: /(node_modules)/
        })
      }*/
      if (process.server) {
        config.externals = [
          nodeExternals({
            whitelist: [/^vuetify/]
          })
        ]
      }
    }
}
}
