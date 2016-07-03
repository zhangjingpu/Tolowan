<div id="form-element-<?php echo $formId; ?>" class="form-group">
  <?php if ($layout == 'inline') { ?>
    <div class="input-group">
      <div class="input-group-addon"><?php echo $label; ?></div><?php echo $element; ?>
    </div>
  <?php } else { ?>
    <h5>
      <label><?php echo $label; ?></label>
      <small class="help-block inline">&nbsp;&nbsp;
        <i
                class="fa fa-fw fa-hand-o-right"></i>
        &nbsp;&nbsp;<?php echo $description; ?>
      </small>
    </h5>
    <div><?php echo $element; ?></div>
  <?php } ?>
</div>

<script type='text/javascript' src="/themes/AdminLTE/dist/js/bootstrap-tag.min.js"></script>
<script type='text/javascript' src="/themes/AdminLTE/dist/js/typeahead.min.js"></script>
<script type="text/javascript">
  (function ($) {
    var tag_input = $('#<?php echo $name; ?>');
    if (!( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()))) {
      tag_input.tag(
              {
                placeholder: tag_input.attr('placeholder'),
                //enable typeahead by specifying the source array
                source: ['aaaaa','bbbbb','cccccc','dddddd'],
              }
      );
    }
    else {
      //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
      tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
      //$('#form-field-tags').autosize({append: "\n"});
    }
  })(jQuery);
</script>