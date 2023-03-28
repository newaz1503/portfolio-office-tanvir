Vue.mixin({
    methods: {
        // =================  get paginate data =================
        get_paginate_data(url, params = null, allData = null, id = null) {
            try {
                this.$root.tableSpinner = true;
                if (id) {
                    url = url + '/' + id;
                } else if (this.$route.query.page) {
                    url = url + "?page=" + this.$route.query.page;
                }
                axios
                    .get(url, { params: params })
                    .then(res => {
                        if (allData) {
                            this.extraData[allData] = res.data;
                        } else {
                            this.table['datas'] = res.data.data;
                            this.table['meta'] = res.data.meta;
                            this.table['links'] = res.data.links;
                        }
                    })
                    .catch(error => console.log(error))
                    .then(alw => this.$root.tableSpinner = false);
                // .then(alw => setTimeout(() => this.$root.tableSpinner = false, 200));
            } catch (e) {
                return e.response;
            }
        },

        // =================  get single data =================
        get_data(model_name, id, dataVar, extra = null) {
            try {
                this.$root.spinner = true;
                axios.get("/" + model_name + "/" + id)
                    .then(res => {
                        if (extra) {
                            this.extraData[dataVar] = res.data;
                        } else {
                            this.data = res.data
                        }
                    })
                    .catch(error => console.log(error))
                    .then(alw => setTimeout(() => (this.$root.spinner = false), 200));
            } catch (e) {
                return e.response;
            }
        },


        // =================  get sorting =================
        get_sorting(namespace) {
            try {
                axios.get("/get-last-sorting", { params: { model: namespace } })
                    .then(res => {
                        if (res.data) {
                            this.data['sorting'] = res.data;
                        }
                    })
            } catch (e) {
                return e.response;
            }
        },



        // =================  store data =================
        store(model_name, data, redirect = null) {
            this.$root.validation_errors = {};
            this.$root.submit = true;
            axios.post("/" + model_name, data)
                .then(res => {
                    if (res.data.message) {
                        this.notification(res.data.message, "success");
                    } else if (res.data.error) {
                        this.notification(res.data.error, "error");
                    } else if (res.data.warning) {
                        this.notification(res.data.warning, "warning");
                    }
                    let url = redirect ? redirect : model_name + '.index';
                    this.$router.push({ name: url });
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.$bvModal.show("validate-error");
                        if (error.response.data.exception) {
                            this.$root.exception_errors = error.response.data.exception
                        } else {
                            this.$root.validation_errors = error.response.data.errors || {};
                        }

                        this.notification("You need to fill empty mandatory fields", "warning");
                    }
                })
                .then(alw => setTimeout(() => (this.$root.submit = false), 400));
        },

        // =================  update data =================
        update(model_name, data, id, image = null, redirect = null) {
            this.$root.validation_errors = {};
            this.$root.submit = true;
            if (image) {
                data.append("_method", "put");
                axios.post("/" + model_name + "/" + id, data)
                    .then(res => {
                        if (res.data.message) {
                            this.notification(res.data.message, "success");
                        } else if (res.data.error) {
                            this.notification(res.data.error, "error");
                        } else if (res.data.warning) {
                            this.notification(res.data.warning, "warning");
                        }
                        setTimeout(() => $(".update_item" + id).addClass("sorting-success"), 1000);
                        setTimeout(() => $(".update_item" + id).removeClass("sorting-success"), 6000);

                        let url = redirect ? redirect : model_name + '.index';
                        this.$router.push({ name: url, query: { page: this.$route.query.page, id: id }, })
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.$bvModal.show("validate-error");
                            if (error.response.data.exception) {
                                this.$root.exception_errors = error.response.data.exception
                            } else {
                                this.$root.validation_errors = error.response.data.errors || {};
                            }
                            this.notification("You need to fill empty mandatory fields", "warning");
                        }
                    })
                    .then(alw => setTimeout(() => (this.$root.submit = false), 400));
            }
            else {
                axios.put("/" + model_name + "/" + id, data)
                    .then(res => {
                        if (res.data.message) {
                            this.notification(res.data.message, "success");
                        } else if (res.data.error) {
                            this.notification(res.data.error, "error");
                        } else if (res.data.warning) {
                            this.notification(res.data.warning, "warning");
                        }
                        setTimeout(() => $(".update_item" + id).addClass("sorting-success"), 1000);
                        setTimeout(() => $(".update_item" + id).removeClass("sorting-success"), 6000);

                        let url = redirect ? redirect : model_name + '.index';
                        this.$router.push({ name: url, query: { page: this.$route.query.page, id: id }, })
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.$bvModal.show("validate-error");
                            if (error.response.data.exception) {
                                this.$root.exception_errors = error.response.data.exception
                            } else {
                                this.$root.validation_errors = error.response.data.errors || {};
                            }
                            this.notification("You need to fill empty mandatory fields", "warning");
                        }
                    })
                    .then(alw => setTimeout(() => (this.$root.submit = false), 400));
            }
        },

        // ================= destroy data =================
        destroy_data(model_name, id, search_data) {
            this.$root.tableSpinner = true;
            axios
                .delete("/" + model_name + "/" + id)
                .then(res => {
                    this.scrollTop(0, 90);
                    this.get_paginate_data(model_name, search_data)
                    if (res.data.message) {
                        this.notification(res.data.message, "success");
                    } else if (res.data.error) {
                        this.notification(res.data.error, "error");
                    }
                })
                .catch(error => console.log(error))
                .then(alw => setTimeout(() => (this.$root.tableSpinner = false), 200));
        },

        // ================= get route name =================
        getRouteName(model) {
            this.table.routes = {
                view: model + ".show",
                edit: model + ".edit",
                destroy: model + ".destroy"
            };
        },
    }
});
