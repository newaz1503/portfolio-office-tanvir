<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <div class="col-lg-10">
                    <form v-on:submit.prevent="search" class="row ml-0">
                        <!------------ Single Input ------------>
                        <div class="col-3">
                            <select
                                v-model="search_data.type"
                                class="form-select form-select-sm"
                            >
                                <option value>Select menu type</option>
                                <option value="content">Content</option>
                                <option value="external_link">External Link</option>
                                <option value="outside_website">Outside Website</option>
                            </select>
                        </div>
                        <!------------ Single Input ------------>
                        <div class="col-3">
                            <select
                                v-model="search_data.position"
                                class="form-select form-select-sm"
                            >
                                <option value>Menu position</option>
                                <option value="header">Header</option>
                                <option value="top_bar">Top Bar</option>
                                <option value="footer_bottom">Footer Bottom</option>
                            </select>
                        </div>
                       <div class="col-6">
                           <Search :fields_name="fields_name"/>
                       </div>
                    </form>
                </div>
                <div class="col-lg-2 text-end">
                    <!--============ Add or Back Button Start ============-->
                    <router-link
                        v-if="$root.checkPermission(model + '.create')"
                        :to="{ name: model + '.create' }"
                        class="btn btn-xs btn-success pull-left  add-and-back"
                        title="Add New"
                    >
                        <i class="fa fa-plus"></i>
                        <span>Add Menu</span>
                    </router-link>
                    <!--============ Add or Back Button End ============-->
                </div>
            </div>
            <div class="data-table">
                <base-table
                    :data="table.datas"
                    :columns="table.columns"
                    :routes="table.routes"
                    thead-classes="bg-light text-secondary"
                ></base-table>
                <Pagination
                    :url="model"
                    v-if="!$root.spinner"
                    :search_data="search_data"
                />
            </div>
        </div>
    </div>
</template>

<script>
    // define model name
    const model = "frontMenu";

    // define table coloumn show in datatable / datalist
    const tableColumns = [
        {field: "parent", title: "Parent", subfield: "title"},
        {field: "title", title: "Title"},
        {field: "type", title: "Menu Type", align: "center"},
        {field: "content", title: "Content", subfield: "title"},
        {
            field: "sorting",
            title: "Sorting",
            sorting: true,
            namespace: "Website-FrontMenu",
            auto: "",
            align: "center",
        },
    ];
    //json fields for export excel
    const json_fields = {
        "Parent Menu": "parent.title",
        Title: "title",
        "Menu Type": "type",
        "Menu Look Type": "menu_look_type",
        Content: "content.title",
        Position: "position",
        Sorting: "sorting",
        "Created at": "created_at",
    };

    export default {
        data() {
            return {
                model: model,
                json_fields: json_fields,
                fields_name: {0: "Select One", title: "Title", sorting: "Sorting"},
                search_data: {
                    pagination: 10,
                    field_name: 0,
                    value: "",
                    type: "",
                    position: "",
                },
                table: {
                    columns: tableColumns,
                    routes: {},
                    datas: [],
                    meta: [],
                    links: [],
                },
            };
        },
        methods: {
            destroy(id) {
                this.destroy_data(this.model, id, this.search_data);
            },
            search() {
                this.$route.query.page = "";
                this.get_paginate_data(this.model, this.search_data);
            },
        },
        async created() {
            this.$root.$loader.$emit('loading', true)
            await this.get_paginate_data(this.model, this.search_data);
            this.getRouteName(this.model);
            this.setBreadcrumbs(this.model, "index", "Menu");
            setTimeout(() => {
                this.$root.$loader.$emit('loading', false)
            }, 500)
        },
    };
</script>
