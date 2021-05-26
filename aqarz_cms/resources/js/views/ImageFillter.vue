<template>
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-label row">

      <div id="fillterss" class="select-div">
        <div class="m-form__group m-form__group--inline">
          <div class="m-form__label lebel-select-div">
            <label>الفلتر:</label>
          </div>
          <div class="m-form__control">

            <select v-model="status_filtter" @change="addStatus" class="form-control m-bootstrap-select" id="m_form_status">
              <option value="00">الكل</option>
              <option value="2">مكتمل التعديلات</option>
              <option value="1">تعديلات جزئية</option>
              <option value="0">غير معدل</option>
            </select>
          </div>
        </div>
      </div>

      <div id="fillterss2" class="select-div">
        <div class="m-form__group m-form__group--inline">
          <div class="m-form__label lebel-select-div">
            <label>تصنيفات الأدمن:</label>
          </div>
          <div class="m-form__control">

            <select v-model="admin_categories_filtter" @change="addAdminCategories" style="opacity: 1 !important;" class="form-control m-bootstrap-select" id="m_form_category_admin">
              <option value="0">الكل</option>
              <option  v-if="categories" v-for="{ id, name,image,slug } in categories" :value="id">{{name}}</option>


            </select>
          </div>
        </div>
      </div>
      <div id="" class="select-div">
        <div class="m-form__group m-form__group--inline">
          <a @click="reset" class="btn btn-success pull-right">تفريغ الفلتر</a>

        </div>
      </div>

      <div class="img-coneiners col-12">

      </div>

    </div>

  </div>
</template>

<script>

  import axios from 'axios';
  export default {
    components: {},
    props: {
      status_filtter: 0, //'='
      admin_categories_filtter: 0, //'='

    },
    data() {
      return {
        categories: [],
      };
    },
    methods: {

      addStatus() {
        let status = this.status_filtter;
        this.$emit("update-status", status);
      },

      addAdminCategories() {
        let admin_categories = this.admin_categories_filtter;
        this.$emit("update_admin_categories", admin_categories);
      },

      reset() {
        let status = 0;
        let admin_categories = 0;
        this.$emit("update-status", status);

        this.$emit("update_admin_categories", admin_categories);
      },


    },
    created() {
      axios.get('/api/admin/categories')
        .then(response => {
          console.log(response.data);
         this.categories= response.data.data

        }).catch(error => {
        console.log(error);

      });
    },
  };
</script>

