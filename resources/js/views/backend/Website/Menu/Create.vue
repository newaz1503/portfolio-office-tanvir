<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <div class="col-lg-2 text-end order-last offset-2">
                    <!--============ Add or Back Button Start ============-->
                    <AddOrBackButton
                        :route="model + '.index'"
                        :portion="model"
                        :icon="'arrow-left'"
                    />
                </div>
            </div>
            <div class="form">
                <form
                    v-on:submit.prevent="submit"
                    enctype="multipart/form-data"
                    id="form"
                    class="row"
                >
                    <!------------ Single Input ------------>
                    <Select
                        v-if="parentMenu"
                        title="Parent Menu"
                        field="parent_id"
                        :req="false"
                        :datas="parentMenu"
                    />
                    <!------------ Single Input ------------>
                    <Input title="Title" field="title" type="text" :req="true"/>
                    <!------------ Single Input ------------>
                    <Select
                        v-if="menu_types"
                        title="Menu Type"
                        field="type"
                        :req="false"
                        :datas="menu_types"
                    />
                    <!------------ Single Input ------------>
                    <Select
                        v-if="menu_look_types"
                        title="Menu look type"
                        field="menu_look_type"
                        :req="false"
                        :datas="menu_look_types"
                    />
                    <!------------ Single Input ------------>
                    <SelectCustom
                        v-if="extraData.contents && data.type == 'content'"
                        title="Content"
                        field="content_id"
                        :req="false"
                        :datas="extraData.contents"
                        val="id"
                        val_title="title"
                    />
                    <!------------ Single Input ------------>
                    <div
                        v-if="
                data.type == 'outside_website' || data.type == 'external_link'
              "
                        class="form-group col-3"
                        :class="{
                'has-error': validation.hasError('data.url'),
                'has-success': data.url,
              }"
                    >
                        <label v-if="data.type == 'outside_website'">URL</label>
                        <label v-if="data.type == 'external_link'">Route Name</label>
                        <input
                            type="text"
                            v-model="data.url"
                            class="form-control form-control-sm"
                            :placeholder="
                  data.type == 'outside_website' ? 'URL' : 'Route Name'
                "
                        />
                        <span class="help-block">{{
                validation.firstError("data.url")
              }}</span>
                    </div>
                    <!------------ Single Input ------------>
                    <Input title="Params" field="params" type="text" :req="false"/>
                    <!------------ Single Input ------------>
                    <Select
                        v-if="positions"
                        title="Menu position"
                        field="position"
                        :req="false"
                        :datas="positions"
                    />
                    <!------------ Single Input ------------>
                    <Input
                        title="Sorting"
                        field="sorting"
                        type="text"
                        :req="true"
                        col="2"
                    />
                    <!------------ Single Input ------------>
                    <Radio
                        title="Status"
                        field="status"
                        statusTitle1=" Active"
                        statusTitle2=" Deactive"
                        value1="active"
                        value2="deactive"
                        :req="true"
                        col="3"
                    />
                    <!-------------- button -------------->
                    <div class="col-12 mb-3 mt-2">
                        <Button title="Submit" process=""/>
                    </div>
                    <!-------------- button -------------->

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    // define model name
    const model = "frontMenu";

    export default {
        data() {
            return {
                selectedValue: null,
                model: model,
                extraData: {
                    contents: [],
                },
                positions: {
                    header: "Header",
                    top_bar: "Top Bar",
                    footer_bottom: "Footer Bottom",
                },
                menu_look_types: {
                    normal: "Normal",
                    mega: "Mega",
                },
                menu_types: {
                    content: "Content",
                    external_link: "External Link",
                    outside_website: "Outside Website",
                },
                parentMenu: {},
                data: {
                    parent_id: "",
                    content_id: "",
                    type: "",
                    position: "header",
                    content: "",
                    menu_look_type: "normal",
                    status: "active",
                    sorting: 0,
                },
            };
        },
        methods: {
            submit: function () {
                const error = this.validation.countErrors();
                this.$validate().then((res) => {
                    // If there is an error
                    if (error > 0) {
                        this.notification(
                            "You need to fill " + error + " more empty mandatory fields",
                            "warning"
                        );
                        return false;
                    }

                    // If there is no error
                    if (res) {
                        if (this.data.slug) {
                            this.update(this.model, this.data, this.data.slug);
                        } else {
                            this.store(this.model, this.data);
                        }
                    }
                });
            },
            get_parent: function () {
                axios.get("/parent-menus").then((res) => (this.parentMenu = res.data));
            },
        },
        created() {
            if (this.$route.params.id) {
                this.setBreadcrumbs(this.model, "edit", "Menu");
                this.get_data(this.model, this.$route.params.id, "data");
            } else {
                this.setBreadcrumbs(this.model, "create", "Menu");
                this.get_sorting("Website-FrontMenu");
            }

            this.get_parent();
            this.get_paginate_data("get-content", {allData: true}, "contents");
        },
        // ================== validation rule for form ==================
        validators: {
            "data.title": function (value = null) {
                return Validator.value(value).required("Title is required");
            },
            "data.type": function (value = null) {
                return Validator.value(value).required("Menu Type is required");
            },
            "data.position": function (value = null) {
                return Validator.value(value).required("Menu Position is required");
            },
            "data.sorting": function (value = null) {
                return Validator.value(value).required("Sorting is required");
            },
            "data.status": function (value = null) {
                return Validator.value(value).required("Status is required");
            },
        },
    };
</script>
