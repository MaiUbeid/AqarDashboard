

<template>

  <div class="users">
    <div v-if="error" class="error">
      <p>{{ error }}</p>
    </div>


    <div class="row">
      <div class="col-lg-8 order-lg-3 order-xl-1">


        <!--begin:: Widgets/Notifications-->
        <div class="kt-portlet kt-portlet--height-fluid">

          <fillter @update-status="update" @update_admin_categories="update_admin_categories" :admin_categories_filtter="admin_categories_filtter" :status_filtter="status_filtter"></fillter>

          <span>Selected Ids: {{ checked }}</span>

          <div class="kt-portlet__body">
            <div class="tab-content">
              <div class="tab-pane active" id="kt_widget6_tab1_content" aria-expanded="true">
                <div class="row">
                  <form action="" id="" class="kt-form form-select-img">
                    <div class="form-group row">


                      <div v-if="images" v-for="{ id, name,image,original_name } in images" id="img-cont" class="col-lg-4">
                        <label class="kt-checkbox kt-checkbox--success checkCont">
                          <input v-model="checked" :value="id" type="checkbox">
                          <span></span>
                          <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slow">
                            <div class="kt-portlet__body-custom">
                              <div class="kt-iconbox__body">
                                <div class="kt-iconbox__icon">
                                  <img :src="image" class="img-check img-fluid" alt="">
                                </div>
                                <div class="kt-iconbox__desc">
                                  <h3 class="kt-iconbox__title">
                                    {{original_name}}
                                  </h3>
                                  <h3 v-model="title_en" id="wirte_name" class="kt-iconbox__title img_title">
                                    {{name}}
                                  </h3>
                                  <div class="kt-iconbox__content">

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </label>
                      </div>


                    </div>
                  </form>

                </div>
                <div class="kt-pagination kt-pagination--sm kt-pagination--success">
                  <button :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
                  {{ paginatonCount }}
                  <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
                </div>

              </div>

            </div>
          </div>

        </div>

        <!--end:: Widgets/Notifications-->
      </div>
      <div class="col-xl-4 col-lg-4 order-lg-3 order-xl-1">

        <!--begin:: Widgets/Support Tickets -->
        <div id="opration_controal" style="" class="kt-portlet kt-portlet--height-fluid">
          <div class="kt-portlet__head">
            <div id="store-img" class="kt-portlet__head-label kt-widget4 store-img title-multi-img">

            </div>

            <div class="kt-portlet__head-toolbar">
              <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                <li class="nav-item">
                  <span id="countImages" class="nav-link active" aria-selected="true" style="">0 صورة</span>
                </li>

              </ul>
            </div>

          </div>
          <div class="kt-portlet__body">
            <!--begin::Portlet-->
            <div class="kt-portlet-custom">

              <!--begin::Form-->
              <form id="idForm" class="form-horizontal" method="POST" action="" enctype="multipart/form-data">


                <input type="hidden" name="ids" id="ids">



                <!-- Start Box Body -->
                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">العنوان عربي</label>
                    <div class="">
                      <input v-model="title_ar" type="text" value="" id="title_ar" name="title_ar" class="form-control" placeholder="العنوان عربي">
                    </div>
                  </div>
                </div><!-- /.box-body -->

                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">العنوان انجليزي</label>
                    <div class="">
                      <input v-model="title_en"  id="title_en" type="text" value="" name="title_en" class="form-control" placeholder="العنوان انجليزي">
                    </div>
                  </div>
                </div>

                <!-- Start Box Body -->
                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">الوسوم عربي</label>
                    <div class="">


                      <Select2   v-model="myValue" :options="myOptions" :settings="{ multiple:true,tags:true }"  @change="myChangeEvent($event)" @select="mySelectEvent($event)" />
                      <button type="button"  class="btn btn-default">نسخ</button>
                      <button  type="button" class="btn btn-default">لصق</button>
                      <button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_ar">مصدر خارجي</button>

                    </div>
                  </div>
                </div><!-- /.box-body -->

                <div class="box-body">

                  <div class="form-group">

                    <label class="control-label">الوسوم انجليزي</label>
                    <div class="">
                      <select name="tag_en[]" multiple class="form-control tag_en">

                      </select>
                      <button type="button"  class="btn btn-default">نسخ</button>
                      <button  type="button" class="btn btn-default">لصق</button>
                      <button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_en">مصدر خارجي</button>

                    </div>
                  </div>
                </div>

                <div class="box-body">

                  <div class="form-group">

                    <label class="control-label">الكلمات الافتتاحية عربي</label>
                    <div class="">
                      <select name="keywords_en[]" multiple class="form-control keywords_en"></select>
                    </div>
                  </div>
                </div>

                <div class="box-body">

                  <div class="form-group">

                    <label class="control-label">الكلمات الافتتاحية انجليزي</label>
                    <div class="">
                      <select name="keywords_ar[]" multiple class="form-control keywords_ar"></select>
                    </div>
                  </div>
                </div>

                <!-- Start Box Body -->
                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">التصنيفات</label>
                    <div class="">
                      <Select2   v-model="selectedCategories" :options="categories" :settings="{ multiple:true,tags:true }"  @change="myChangeEvent($event)" @select="mySelectEvent($event)" />

                    </div>
                  </div>
                </div><!-- /.box-body -->


                <!-- Start Box Body -->
                <div style="display: none" class="box-body">
                  <div class="form-group">
                    <label class="control-label">كيفية استخدام الصورة</label>
                    <div class="">
                      <select name="how_use_image" class="form-control">
                        <option value="free">مجاني</option>
                        <option value="free_personal">شخصي</option>
                        <option value="editorial_only">لتعديل فقط</option>
                        <option value="web_only">للويب فقط</option>

                      </select>
                    </div>
                  </div>
                </div><!-- /.box-body -->


                <!-- Start Box Body -->
                <div class="box-body">
                  <div class="form-group">
                    <label class=" control-label">الوصف (اختياري)</label>
                    <div class="">

                      <textarea  name="description_ar" rows="4" id="description_ar" class="form-control" placeholder="الوصف عربي"></textarea>
                    </div>
                  </div>
                </div><!-- /.box-body -->

                <div class="box-body">
                  <div class="form-group">
                    <label class=" control-label">الوصف انجليزي (اختياري)</label>
                    <div class="">

                      <textarea  name="description_en" rows="4" id="description_en" class="form-control" placeholder="الوصف انجليزي"></textarea>
                    </div>
                  </div>
                </div>


                <div class="box-body">
                  <div class="form-group">
                    <label class="control-label">تصنيف المدير</label>
                    <div class="">
                      <select name="category_admin_id" class="form-control  category_admin_id">
                        <option value="null">اختر تصنيف ادمن</option>

                      </select>


                    </div>
                  </div>
                </div><!-- /.box-body -->


                <!-- Start Box Body -->



                <!-- Start Box Body -->


                <!-- Start Box Body -->




                <div class="box-footer">

                  <button type="submit" class="btn btn-success pull-right">حفظ</button>
                </div><!-- /.box-footer -->
              </form>


              <!--end::Form-->
            </div>

            <!--end::Portlet-->
          </div>
        </div>

        <!--end:: Widgets/Support Tickets -->
      </div>

    </div>


  </div>
</template>
<script>
  var admin_categories = null;
  import axios from 'axios';

  import fillter from './ImageFillter';
  import app from './App';


  const getUsers = (page, status = null, admin_categories, callback) => {
    const params = {page: page, status: status, admin_categories: admin_categories};
    axios.get('/api/file/store', {params})
      .then(response => {
        callback(null, response.data);
      }).catch(error => {
      console.log(error);
      callback(error, error.response.data);
    });
  };
  import Select2 from 'v-select2-component';
  export default {
    components: {
      fillter,
      app,
      Select2
    },
    data() {
      return {
        images: null,
        meta: null,
        status_filtter: 0,
        admin_categories_filtter: 0,
        links: {
          first: null,
          last: null,
          next: null,
          prev: null,
        },
        error: null,
        checked: [],
        myValue: [],
        categories: [],
        selectedCategories: [],
        title_ar: null,
        title_en: null,
        myOptions: []
      };
    },
    computed: {
      foo() {
        return this.checked;
      },
      checkAll: {

        get: function () {
          return this.images ? this.checked.length == this.images.length : false;

        },
        set: function (value) {


          var checked = [];
          if (value) {

            this.images.forEach(function (lang) {
              console.log(lang);
              checked.push(lang.id);

            });





          }

        //  this.checked = checked;






        },
      },


      nextPage() {
        if (!this.meta || this.meta.current_page === this.meta.last_page) {
          return;
        }

        return this.meta.current_page + 1;
      },
      prevPage() {
        if (!this.meta || this.meta.current_page === 1) {
          return;
        }
        return this.meta.current_page - 1;
      },

      statusFiltter() {
        this.checked = [];
        return this.status_filtter;
      },
      adminCategoriesFiltter() {
        this.checked = [];
        return this.admin_categories_filtter;
      },

      paginatonCount() {
        if (!this.meta) {
          return;
        }
        const {current_page, last_page} = this.meta;
        return `${current_page} of ${last_page}`;
      },


    },

    created() {
      const params = {page: null};


      axios.get('/api/categories', {params})
        .then(response => {

          //    this.categories=response.data;
          this.categories = response.data.map((item) => {
            return {
              id: item.id,
              text: item.name,

            };
          });


          console.log(this.categories);

        }).catch(error => {
        console.log(error);

      });
    },
    watch: {




      foo()
      {

        console.log(this.checked);
        const params = {ids: this.checked};

        var is_default_ar=0;
        var is_default_en=0;
        if(this.checked.length>0)
        {


          axios.get('/api/categories', {params})
            .then(response => {

              //    this.categories=response.data;
             /* response.data.forEach(function (item) {

                if(this.checked.length==1)
                {

                  this.title_ar=item.title_ar;
                  this.title_en=item.title_en;

                }
                else
                {




                  if(item.title_ar !== this.title_ar )
                  {
                    this.title_ar='قيم مختلفة';

                  }
                  else
                  {
                    this.title_ar=item.title_ar;
                  }
                  if(item.title_en !== this.title_en )
                  {
                    this.title_en='mix value';

                  }
                  else
                  {
                    this.title_ar=item.title_ar;
                  }
                }



                this.selectedCategories.push(item.id_cat);




                this.selectedCategories=       [...new Set( this.selectedCategories)]

              }.bind(this));
*/
               for(var i=0;i< response.data.length;i++)
               {
                      if(this.checked.length==1)
                {

                  this.title_ar=response.data[i].title_ar;
                  this.title_en=response.data[i].title_en;

                }
                else
                {


                  if (i + 1 < response.data.length) {
                    if(response.data[i].title_ar !== response.data[i+1].title_ar )
                    {
                      is_default_ar=1;


                    }

                    if(response.data[i].title_en !== response.data[i+1].title_en )
                    {
                      is_default_en=1;


                    }
                  }



                }




                if(is_default_ar==1)
                {
                  this.title_ar='قيم مختلفة'
                }
                else
                {
                  this.title_ar=response.data[i].title_ar;

                }

                 if(is_default_en==1)
                 {
                   this.title_en='mix value'
                 }
                 else
                 {

                   this.title_en=response.data[i].title_en;
                 }


                this.selectedCategories.push(response.data[i].id_cat);




                this.selectedCategories=       [...new Set( this.selectedCategories)]
               }

              console.log(this.selectedCategories);

            }).catch(error => {
            console.log(error);

          });
        }
        else
        {

          this.selectedCategories=[];
        }


      },


      statusFiltter() {
        const params = {page: null, status: this.status_filtter, admin_categories: this.admin_categories_filtter};
        axios.get('/api/file/store', {params})
          .then(response => {

            this.images = response.data.data;
            this.links = response.data.links;
            this.meta = response.data.meta;
            const path = `/panel/admin/image_store_with_vue/store`;
            this.$router.push(path);
          }).catch(error => {
          console.log(error);

        });
        //    console.log('Foo Changed!',this.status_filtter);
      },
      adminCategoriesFiltter() {
        const params = {page: null, status: this.status_filtter, admin_categories: this.admin_categories_filtter};
        axios.get('/api/file/store', {params})
          .then(response => {

            this.images = response.data.data;
            this.links = response.data.links;
            this.meta = response.data.meta;
            const path = `/panel/admin/image_store_with_vue/store`;
            this.$router.push(path);
          }).catch(error => {
          console.log(error);

        });
        //    console.log('Foo Changed!',this.status_filtter);
      },
      setTagArOptions()
      {

      },




    },
    beforeRouteEnter(to, from, next) {

      getUsers(to.query.page, status, admin_categories, (err, data) => {

        next(vm => vm.setData(err, data));
      });
    },
    // when route changes and this component is already rendered,
    // the logic will be slightly different.
    beforeRouteUpdate(to, from, next) {
      this.images = this.links = this.meta = null;
      status = this.status_filtter;
      admin_categories = this.admin_categories_filtter;
      getUsers(to.query.page, status, admin_categories, (err, data) => {
        this.setData(err, data);
        next();
      });
    },

    methods: {

      myChangeEvent(val){
        console.log(val);
      },
      mySelectEvent({id, text}){
        console.log({id, text})
      },
      update(status) {

        this.status_filtter = status;

      },

      update_admin_categories(admin_categories) {

        this.admin_categories_filtter = admin_categories;

      },

      goToNext() {


        this.$router.push({
          name: 'images.store.index',
          query: {
            page: this.nextPage,
            status: this.statusFiltter,
            admin_categories: this.adminCategoriesFiltter,
          },
        });
      },
      goToPrev() {
        this.$router.push({
          // name: 'users.index',
          query: {
            page: this.prevPage,
            status: this.statusFiltter,
            admin_categories: this.adminCategoriesFiltter,
          },
        });
      },
      setData(err, {data: users, links, meta}) {


        this.images = users;
        this.links = links;
        this.meta = meta;

        /* if (err) {
           this.error = err.toString();
         }*/
        /* else {
           this.images = users;
           this.links = links;
           this.meta = meta;
         }*/
      },


    },
  };
</script>