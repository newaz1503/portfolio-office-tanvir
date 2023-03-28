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
            <div class="form" v-if="!$root.spinner">
                <form
                    v-on:submit.prevent="submit"
                    enctype="multipart/form-data"
                    id="form"
                    class="row"
                >
                    <!------------ Single Input ------------>
                    <Input title="Title" field="title" col="4" :req="true"/>
                    <!------------ Single Input ------------>
                    <File
                        title="Image"
                        field="image"
                        mime="img"
                        :req="true"
                        fileClassName="file1"
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
                        statusTitle1="Active"
                        statusTitle2="Deactive"
                        value1="active"
                        value2="deactive"
                        :req="true"
                        col="3"
                    />
                    <!------------ Single Input ------------>
                    <div class="form-group col-12">
                        <label class="col-12 p-0">Description</label>
                        <div class="col-12 p-0">
                            <editor :editorModel="'description'"/>
                        </div>
                    </div>

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
    const model = "page";

    export default {
        data() {
            return {
                model: model,
                data: {image: "", sorting: 0,status:'active'},
                image: {},
                errors: {},
            };
        },
        methods: {
            submit: function () {
                this.$validate().then((res) => {
                    const error = this.validation.countErrors();
                    // If there is an error
                    if (error > 0) {
                        console.log(this.validation.allErrors());
                        this.notification(
                            "You need to fill " + error + " more empty mandatory fields",
                            "warning"
                        );
                        return false;
                    }

                    // If there is no error
                    if (res) {
                        var form = document.getElementById("form");
                        var formData = new FormData(form);
                        if (this.data.description) {
                            formData.append("description", this.data.description);
                        } else {
                            formData.append("description", "");
                        }
                        if (this.data.slug) {
                            this.update(this.model, formData, this.data.slug,'image');
                        } else {
                            this.store(this.model, formData);
                        }
                    }
                });
            },
        },
        created() {
            if (this.$route.params.id) {
                this.setBreadcrumbs(this.model, "edit");
                this.get_data(this.model, this.$route.params.id, "data");
            } else {
                this.setBreadcrumbs(this.model, "create");
            }
        },

        // ================== validation rule for form ==================
        validators: {
            "data.title": function (value = null) {
                return Validator.value(value).required("Title is required");
            },
            "data.image": function (value = null) {
                return Validator.value(value).required("Image is required")
            },
            "data.status": function (value = null) {
                return Validator.value(value).required("Status is required");
            },
            "data.sorting": function (value = null) {
                return Validator.value(value).required("Sorting is required");
            },
        },
    };
</script>
