<div class="container">
    <?php 
    // print_r($_SESSION); exit;
    $given_by = $_SESSION['user_id'];
        foreach ($users as $user): ?>


<div class="row">
    <div class="col-md-6">
        <img class="img-fluid rounded-circle" height="300px" width="300x"
        src="<?=base_url();?>images/<?php echo $user['images']; ?>" alt="User profile picture">
    </div>
    <div class="col-md-6">
            <h2>Add a review for <?php echo $user['name']; ?></h2>
            <form method="post" action="<?php echo base_url('user/submit_review/'.$user['id'] .'/'.$given_by ); ?>">
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="1">1 star</option>
                        <option value="2">2 stars</option>
                        <option value="3">3 stars</option>
                        <option value="4">4 stars</option>
                        <option value="5">5 stars</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>