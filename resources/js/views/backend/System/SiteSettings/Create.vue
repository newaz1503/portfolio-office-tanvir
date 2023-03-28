<template>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 justify-content-end">
                <div class="col-lg-2 text-end order-last offset-2">
                    <!--============ Add or Back Button Start ============-->
                    <!-- <AddOrBackButton
                        :route="model + '.index'"
                        :portion="model"
                        :icon="'arrow-left'"
                    /> -->
                </div>
            </div>
            <div class="form">
                <form
                    v-on:submit.prevent="submit"
                    id="form"
                    enctype="multipart/form-data"
                    class="row"
                >
                    <!------------ Single Input ------------>
                    <Input title="Title" field="title" type="text" :req="true"/>
                    <!------------ Single Input ------------>
                    <!-- <Input
                        title="Short Title"
                        field="short_title"
                        type="text"
                        :req="true"
                    /> -->
                    <!------------ Single Input ------------>
                    <File
                        title="Logo"
                        field="logo"
                        mime="img"
                        :req="true"
                        fileClassName="file1"
                    />
                    <!------------ Single Input ------------>
                    <!-- <File
                        title="Logo Small"
                        field="logo_small"
                        mime="img"
                        :req="false"
                        fileClassName="file2"
                    /> -->
                    <!------------ Single Input ------------>
                    <File
                        title="Favicon Logo"
                        field="favicon"
                        mime="img"
                        :req="false"
                        fileClassName="file3"
                    />
                    <!------------ Single Input ------------>
                    <!-- <Input
                        title="Contact Email"
                        field="contact_email"
                        type="email"
                        :req="false"
                    /> -->
                    <!------------ Single Input ------------>
                    <!-- <Input
                        title="Feedback Email"
                        field="feedback_email"
                        type="email"
                        :req="false"
                    /> -->
                    <!------------ Single Input ------------>
                    <Input
                        title="Mobile Number"
                        field="mobile1"
                        type="number"
                        :req="false"
                    />
                    <!------------ Single Input ------------>
                    <!-- <Input
                        title="Mobile Two"
                        field="mobile2"
                        type="number"
                        :req="false"
                    /> -->
                    <!------------ Single Input ------------>
                    <!-- <Textarea title="Address" field="address" type="text" :req="false" col="6"/> -->
                    <!-- <Input title="Web" field="web" type="url" :req="false" col="6"/> -->
                    <div class="w-100 my-2"></div>

                    <Input title="Facebook" field="fb" type="url" :req="false"/>
                    <Input title="Twitter" field="tw" type="url" :req="false"/>
                    <Input title="Linkedin" field="ln" type="url" :req="false"/>
                    <Input title="Youtube" field="yt" type="url" :req="false"/>

                    <!-- <Textarea title="Map" field="map" :req="false" col="12"/> -->
                    <!------------ Single Input ------------>
                    <!------------ Single Input ------------>
                    <div class="col-lg-6 py-2">
                        <h5>Paypal payment method</h5>
                        <Input
                        title="Client id"
                        field="client_id"
                        type="text"
                        :req="false"
                        col="12"
                        />
                        <Input
                            title="Client Secret"
                            field="client_secret"
                            type="text"
                            :req="false"
                            col="12"
                        />
                    </div>
                    <!------------ Single Input ------------>
                    <div class="col-lg-6 py-2">
                        <h5>Change Header Info</h5>
                        <Input
                        title="Header title"
                        field="header_title"
                        type="text"
                        :req="false"
                        col="12"
                        />

                        <File
                            title="Sale Page Header Image"
                            field="header_image"
                            mime="img"
                            :req="true"
                            fileClassName="file5"
                        />
                    </div>
                    <Textarea title="Address" field="address" type="text" :req="false" col="6"/>

                    <Meta/>
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
    const model = "siteSetting";

    export default {
        data() {
            return {
                model: model,
                data: {logo: "", logo_small: "", favicon: "", header_image: ""},
                image: {},
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
                        if (this.image.logo) {
                            formData.append("logo", this.image.logo);
                        } else {
                            formData.append("logo", "");
                        }
                        if (this.image.logo_small) {
                            formData.append("logo_small", this.image.logo_small);
                        } else {
                            formData.append("logo_small", "");
                        }
                        if (this.image.favicon) {
                            formData.append("favicon", this.image.favicon);
                        } else {
                            formData.append("favicon", "");
                        }
                        if (this.image.header_image) {
                            formData.append("header_image", this.image.header_image);
                        } else {
                            formData.append("header_image", "");
                        }
                        this.store(this.model, formData,'siteSetting.create');
                    }
                });
            },
            onFileChange(e, model, fileClass, pdf = null) {
                this.showImage(e, model, model, fileClass, pdf); // 1st data image, second show image
            },
        },
        created() {
            if (this.$route.params.id) {
                this.setBreadcrumbs(this.model, "edit", "Site Setting");
                // this.get_data(this.model, this.$route.params.id, "data");
            } else {
                this.setBreadcrumbs(this.model, "create", "Site Setting");
            }
            axios.get(this.model).then(res => {
                this.data = res.data;
            })
        },

        // ================== validation rule for form ==================
        validators: {
            "data.title": function (value = null) {
                return Validator.value(value).required("Title is required");
            },
            // "data.short_title": function (value = null) {
            //     return Validator.value(value).required("Short Title is required");
            // },
            "data.logo": function (value = null) {
                return Validator.value(value).required("Logo is required");
            },
        },
    };
</script>
