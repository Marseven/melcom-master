<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="text-align: center;margin: 0px;  margin-bottom: 0px;" class="alert alert-block alert-error">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    <?= $message ?>
</div>
