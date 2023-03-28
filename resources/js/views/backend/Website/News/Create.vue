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
                    <div
                        class="form-group col-3"
                        :class="{
                            'has-error': validation.hasError('data.date'),
                            'has-success': data.date,
                          }"
                    >
                        <label>Date <span class="text-red">*</span></label>
                        <datepicker
                            v-model="data.date"
                            format="D dsu MMM yyyy"
                            placeholder="Select Date"
                            class="form-control form-control-sm custom-datepicker"
                            name="date"
                        ></datepicker>
                        <span class="help-block">
                {{ validation.firstError("data.date") }}
              </span>
                    </div>

                    <!------------ Single Input ------------>
                    <Input
                        title="Title"
                        field="title"
                        type="text"
                        col="4"
                        :req="true"
                    />
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
                    <div class="form-row col-12">
                        <label class="col-12">Description</label>
                        <div class="col-12">
                            <editor :editorModel="'description'"/>
                        </div>
                    </div>
                    <!-------------- button -------------->
                    <div class="col-12 mb-3 mt-3">
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
    const model = "news";

    export default {
        data() {
            return {
                model: model,
                data: {image: "", sorting: 0},
                image: {},
                errors: {},
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
                        var form = document.getElementById("form");
                        var formData = new FormData(form);
                        if (this.data.description) {
                            formData.append("description", this.data.description);
                        } else {
                            formData.append("description", "");
                        }
                        if (this.data.slug) {
                            this.update(this.model, formData, this.data.slug, "image");
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
                this.get_sorting("Website-News");
            }
        },

        // ================== validation rule for form ==================
        validators: {
            "data.date": function (value = null) {
                return Validator.value(value).required("Date is required");
            },
            "data.title": function (value = null) {
                return Validator.value(value).required("Title is required");
            },
            "data.image": function (value = null) {
                return Validator.value(value)
                    .required("Image is required")
                    .custom(function () {
                        if (!value.type) {
                            return false;
                        }
                        if (!Validator.isEmpty(value)) {
                            var type = value.type;
                            if (
                                type == "image/jpeg" ||
                                type == "image/jpg" ||
                                type == "image/png"
                            ) {
                            } else {
                                return "Image must be of type .jpg .jpeg or .png";
                            }
                        }
                    });
            },
            "data.sorting": function (value = null) {
                return Validator.value(value).required("Sorting is required");
            },
        },
    };
</script>
