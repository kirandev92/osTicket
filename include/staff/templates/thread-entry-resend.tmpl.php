<h3 class="drag-handle"><?php echo __('Resend Entry'); ?></h3>
<b><a class="close" href="#"><i class="icon-remove-circle"></i></a></b>
<hr/>

<form method="post" action="<?php echo $this->getAjaxUrl(true); ?>">

<div class="thread-body" style="background-color: transparent; max-height: 150px; width: 100%; overflow: scroll;">
    <?php echo $this->entry->getBody()->toHtml(); ?>
</div>

<?php if ($this->entry->type == 'R') { ?>
<div style="margin:10px 0;"><strong><?php echo __('Signature'); ?>:</strong>
    <label><input type="radio" name="signature" value="none" checked="checked"> <?php echo __('None');?></label>
    <?php
    if ($poster
        && $poster->getId() != $thisstaff->getId()
        && $poster->getSignature()
    ) { ?>
    <label><input type="radio" name="signature" value="theirs"
        <?php echo ($info['signature']=='theirs')?'checked="checked"':''; ?>> <?php echo __('Their Signature');?></label>
    <?php
    }
    if ($thisstaff->getSignature()) {?>
    <label><input type="radio" name="signature" value="mine"
        <?php echo ($info['signature']=='mine')?'checked="checked"':''; ?>> <?php echo __('My Signature');?></label>
    <?php
    } ?>
    <?php
    if ($T = $this->entry->getThread()->getObject()) {
        $dept = $T instanceof Ticket ? $T->getTopic()->dept : $T->getDept();
    }
    if ($dept && $dept->canAppendSignature()) { ?>
    <label><input type="radio" name="signature" value="dept"
        <?php echo ($info['signature']=='dept')?'checked="checked"':''; ?>>
        <?php echo sprintf(__('%s Signature (%s)'), $T instanceof Ticket ? 'Product' : 'Department', Format::htmlchars($dept->getName())); ?></label>
    <?php
    } ?>
</div>
<?php } # end of type == 'R' ?>

<hr>
<p class="full-width">
    <span class="buttons pull-left">
        <input type="button" name="cancel" class="close"
            value="<?php echo __('Cancel'); ?>">
    </span>
    <span class="buttons pull-right">
        <button type="submit" name="commit" value="resend" class="button">
            <?php echo __('Resend'); ?>
        </button>
    </span>
</p>

</form>
