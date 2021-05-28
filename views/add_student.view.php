<form class="w-50 mx-auto" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
    <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" name="fullName" value="<?= $data['fullName'] ?? ''?>" class="form-control" id="fullName" aria-describedby="fullNameHelp">
        <small class="text-danger"><?= $data['fullNameError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="username">Username</label> (<small class="text-secondary">Must be unique</small>)
        <input type="text" name="username" value="<?= $data['username'] ?? ''?>" class="form-control" id="username" aria-describedby="usernameHelp">
        <small class="text-danger"><?= $data['usernameError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="parentName">Parent Name</label>
        <input type="text" name="parentName" value="<?= $data['parentName'] ?? ''?>" class="form-control" id="parentName" aria-describedby="parentNameHelp">
        <small class="text-danger"><?= $data['parentNameError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="relationship">Parent Name</label>
        <select name="relationship" id="relationship" class="form-control">
            <option value="">Select a relation</option>
            <option value="Mother">Mother</option>
            <option value="Father">Father</option>
        </select>
        <small class="text-danger"><?= $data['relationshipError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="contactNumber">Contact Number</label>
        <input type="text" name="contactNumber" value="<?= $data['contactNumber'] ?? ''?>" class="form-control" id="contactNumber" aria-describedby="contactNumberHelp">
        <small class="text-danger"><?= $data['contactNumberError'] ?? '' ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>