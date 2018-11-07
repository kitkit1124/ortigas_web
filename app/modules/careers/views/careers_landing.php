<a id="form_landing_button" data-toggle="modal" data-target="#form_landing">&nbsp;</a>
<!-- Modal -->
<div class="modal fade" id="form_landing" tabindex="-1" role="dialog" aria-labelledby="Form" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="times_button">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php if($careers_landing) { echo parse_content($careers_landing->partial_content); } ?>
      </div>
    </div>
  </div>
</div>