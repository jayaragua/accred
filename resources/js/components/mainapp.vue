<template>
    <div>
        <div v-if="$store.state.user">
      <!--========== ADMIN SIDE MENU one ========-->
                  <div class="_1side_menu" >
                    <div class="_1side_menu_logo">
                      <h3 style="text-align:center;">GADTC</h3>
                      <!--<img src="/img/logo.jpg" style="width: 108px;margin-left: 68px;"/>-->
                    </div>

                    <!--~~~~~~~~ MENU CONTENT ~~~~~~~~-->
                    <div class="_1side_menu_content">
                      <div class="_1side_menu_img_name">
                        <!-- <img class="_1side_menu_img" src="/images/pic.png" alt="" title=""> -->
                        <Icon type="md-contact" color="#4888e9" size="100" />
                        <p class="_1side_menu_name">{{user.name}}</p>
                      </div>
                
                      <!--~~~ MENU LIST ~~~~~~-->
                      <div class="_1side_menu_list">
                          <hr>
                        <template v-if="condition">
                        <ul class="_1side_menu_list_ul">
                          <li><router-link to="/"><Icon type="ios-speedometer" /> Dashboard</router-link></li>
                          <li> <router-link to="Deliverable"><Icon type="ios-apps" /> Deliverables</router-link></li>
                          <li> <router-link to="area"><Icon type="md-list-box" /> Area</router-link></li>
                          <li> <router-link to="multiupload"><Icon type="ios-apps" /> Files</router-link></li>
                          <li> <router-link to="accred_finding"><Icon type="ios-create" />Findings</router-link></li>
                          <li> <router-link to="users"><Icon type="md-person" /> Users</router-link></li>
                          <li> <a href="/logout"><Icon type="md-power" /> Logout</a></li>
                        </ul></template>
                         <template v-else>
                         <ul class="_1side_menu_list_ul">
                          <li><router-link to="/"><Icon type="ios-speedometer" /> Dashboard</router-link></li>
                          <li> <router-link to="Deliverable"><Icon type="ios-apps" /> Deliverables</router-link></li>
                          <li> <a href="/logout"><Icon type="md-power" /> Logout</a></li>
                        </ul></template>







                      </div>


                    </div>
                  </div>

                  <!--========== ADMIN SIDE MENU ========-->

                  <!--========= HEADER ==========-->
                  <div class="header">
                    <div class="_2menu _box_shadow">
                      <div class="_2menu_logo">
                        <ul class="open_button">
                          <li>
                            <!-- <Icon type="ios-list" /> -->
                          </li>
                          <!--<li><Icon type="ios-albums" /></li>-->
                        </ul>
                      </div>
                    </div>
                  </div>
      <!--========= HEADER ==========-->
    </div>
    	<router-view/>
    </div>
</template>

<script>
    export default {
      props:['user'],
      data(){
        return{
          isLogin: false,
        }

      },
      created(){
        this.$store.commit('updateUser', this.user)
       
      },

    computed: {
        condition() {
          this.user;
          return this.user.userType == 'Admin';
        }
  }

     


    }
</script>
