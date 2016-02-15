<?php
$user = $this->get('user');

if ($profilfield->getId()) {
    $fieldsetLegend = $this->getTrans('editProfilfields');
} else {
    $fieldsetLegend = $this->getTrans('addProfilfields');
}
?>

<fieldset>
    <legend><?=$fieldsetLegend ?></legend>
    <form action="<?=$this->getUrl(array('action' => 'treat')) ?>"
          method="POST"
          class="form-horizontal"
          id="userForm">
        <?=$this->getTokenField() ?>
        <input name="profilfield[id]"
               type="hidden"
               value="<?=$profilfield->getId() ?>" />
        <div class="form-group">
            <label for="profilfieldName"
                   class="col-lg-3 control-label">
                <?=$this->getTrans('profilfieldName') ?>
            </label>
            <div class="col-lg-9">
                <input name="profilfield[title]"
                       type="text"
                       id="profilfieldName"
                       class="form-control required"
                       placeholder="<?=$this->getTrans('profilfieldName') ?>"
                       value="<?=$this->escape($profilfield->getProfilfieldName()) ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="profilfieldIcon" class="col-lg-3 control-label">
                <?=$this->getTrans('profilfieldIcon') ?>
            </label>
            <div class="col-lg-9">
                <input name="profilfield[icon]"
                       type="text"
                       id="profilfieldIcon"
                       class="form-control required email"
                       placeholder="<?=$this->getTrans('profilfieldIcon') ?>"
                       value="<?=$this->escape($profilfield->getIcon()) ?>" />
            </div>
        </div>
        
        
        <div class="form-group">
            <label for="assignedGroups" class="col-lg-3 control-label">
                    <?=$this->getTrans('assignedGroups') ?>
            </label>
            <div class="col-lg-9">
                <select id="assignedGroups"
                        class="chosen-select form-control"
                        data-placeholder="<?=$this->getTrans('selectAssignedGroups') ?>"
                        multiple
                        name="user[groups][]">
                        <?php
                        foreach ($this->get('groupList') as $group) {
                            ?>
                            <option value="<?=$group->getId() ?>"
                                    <?php
                                    foreach ($user->getGroups() as $assignedGroup) {
                                        if ($group->getId() === $assignedGroup->getId()) {
                                            echo 'selected="selected"';
                                            break;
                                        }
                                    }
                                    ?>>
                                <?=$this->escape($group->getName()) ?>
                            </option>
                            <?php
                        }
                        ?>
                </select>
            </div>
        </div>
        <?=$this->getSaveBar() ?>
    </form>
</fieldset>

<script>
$('#assignedGroups').chosen();
$('#assignedGroups_chosen').css('width', '100%'); // Workaround for chosen resize bug.
$('#userForm').validate();
</script>
