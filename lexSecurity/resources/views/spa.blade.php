<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
  <div id="app">
    <template>
        <v-app id="inspire">
          <v-navigation-drawer
            v-model="drawer"
            app
          >
            <v-list dense>
              <v-list-item link>
                <v-list-item-action>
                  <v-icon>mdi-home</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Home</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item link>
                <v-list-item-action>
                  <v-icon>mdi-email</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Contact</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-navigation-drawer>
      
          <v-app-bar
            app
            color="indigo"
            dark
          >
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Application</v-toolbar-title>
          </v-app-bar>
      
          <v-main>
            <v-container
              class="fill-height"
              fluid
            >
              <v-row
                align="center"
                justify="center"
              >
                <v-col class="text-center">
                  <v-tooltip left>
                    <template v-slot:activator="{ on }">
                      <v-btn
                        :href="source"
                        icon
                        large
                        target="_blank"
                        v-on="on"
                      >
                        <v-icon large>mdi-code-tags</v-icon>
                      </v-btn>
                    </template>
                    <span>Source</span>
                  </v-tooltip>
                </v-col>
              </v-row>
            </v-container>
          </v-main>
          <v-footer
            color="indigo"
            app
          >
            <span class="white--text">&copy; {{ new Date().getFullYear() }}</span>
          </v-footer>
        </v-app>
      </template>
  </div>

  <script>
    export default {
      props: {
        source: String,
      },
      data: () => ({
        drawer: null,
      }),
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script>
    new Vue({
      el: '#app',
      vuetify: new Vuetify(),
    })
  </script>

</body>
</html>