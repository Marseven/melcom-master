<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="text-align: center;margin: 0px;  margin-bottom: 0px;" class="alert alert-block alert-<?= h($class) ?>">
    <button type="button" class="close" data-dismiss="alert">
        <i class="ace-icon fa fa-times"></i>
    </button>
    <?= $message ?>
</div>
