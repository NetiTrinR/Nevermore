<div class="modal fade" id="tag-modal" tabindex="-1" role="dialog" aria-labelledby="tag-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#999;">&times;</button>
		<h4 class="modal-title">Create New Tag</h4>
      </div>
      <div class="modal-body">
        <p>Tags are important on Nevermore forums.  They catagorize the forums, enable feeds, and are used when searching for existing threads. <b>Try to make tags general and useable for others!</b></p>
		<p>Type as many new tags as you want delimted by a space.  If you want a space in the tag name, use an underscore. <b>Please search for duplicate tags</b> before creating new ones. Note that Tag names are moderated under <a href="{{URL::route('rules')}}#web">Website rules 1;4;5;8</a>, and should be considered when creating a tag.</p>
		<div class="form-group">
			<label for="tag" class="control-label">New tags</label>
		    <input name="tag" id="tag" value="" type="text" class="form-control" placeholder="kittens space_ships etc.">
		    <span id="tag-help-block" class="help-block"></span>
		</div>
      </div>
      <div class="modal-footer">
      	<button type="button" id="tag-submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->