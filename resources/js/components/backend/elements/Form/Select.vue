<template>
    <div class="form-group" :class="getClass()">
        <label :class="req ? 'control-label' : ''">{{ title }}</label>
            <select
              v-model="$parent.data[field]"
              :name="field"
              :disabled="disable ? true : false"
              :readonly="readOnly ? true : false"
              class="form-select form-select-sm"
            >
              <option value>{{ title }}</option>
              <option
                v-for="(value, name, index) in datas"
                :key="index"
                v-bind:value="name"
              >
                {{ value }}
              </option>
            </select>
<!--        <v-select-->
<!--            :name="field"-->
<!--            :disabled="disable ? true : false"-->
<!--            :readonly="readOnly ? true : false"-->
<!--            :options="datas"-->
<!--            v-model="$parent.data[field]"-->
<!--            :searchable="true"-->
<!--            @click="selectItem()"-->
<!--        />-->
        <span class="help-block">{{
                $parent.validation.firstError("data." + field)
            }}</span>
    </div>
</template>

<script>
import VSelect from '@alfsnd/vue-bootstrap-select'

export default {
    components: {
        VSelect
    },
    props: ["title", "field", "col", "req", "datas", "disable", "readOnly"],
    data(){
        return{
            newDatas:[]
        }
    },

    methods: {
        getClass() {
            let col = this.col ? this.col : 3;
            let className = "col-" + col + " ";
            if (this.$parent.validation.hasError("data." + this.field)) {
                className += "has-error";
            } else if (this.$parent.data[this.field]) {
                className += "has-success";
            }
            return className;
        },
        // mapfunction(){
        //     // let selectOptions = this.datas.map(function (value,key){
        //     //     return value+' ' + key;
        //     // })
        //     console.log('key =>'+ Object.keys(this.datas)+ '   '+'value =>'+Object.values(this.datas))
        // },

    },

    created() {

    },

};
</script>
<style>
.v-bs-searchbox input {
    height: 30px;
    font-size: 12px !important;
}

.v-select-toggle {
    color: #212529;
    background-color: #ffffff !important;
    border: 1px solid #b2b2b244 !important;
    padding: 0.3rem 0.75rem !important;
}
</style>
