<template>
  <div class="col-lg-12">
    <div class="modal-dialog modal-success">
      <div class="modal-content">
        <div class="modal-header">
          <div class="icon-box">
            <i class="mdi mdi-check"></i>
          </div>
          <h4 class="modal-title col-12">Success!</h4>
        </div>
        <div class="modal-body">
          <p class="text-center">Your payment has been confirmed. Thank You.</p>
        </div>
        <div class="modal-footer">
          <router-link
            :to="{ name: 'dashboard' }"
            class="btn btn-success btn-block"
            data-dismiss="modal"
            >OK</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>