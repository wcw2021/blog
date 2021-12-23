                </div> <!-- end of col-sm-8 blog main--> 



                <div class="col-sm-3 offset-sm-1 blog-sidebar">
                    <div class="sidebar-module sidebar-module-inset">
                        <h4>About</h4>
                        <p><?php echo $site_description; ?></p>
                    </div>
                    
                    <div class="sidebar-module">
                        <h4>Categories</h4>
                        <?php if($categories) : ?>
                            <ol class="list-unstyled">
                                <?php foreach($categories as $category) : ?>
                                    <li><a href="posts.php?category=<?php echo urlencode($category->id); ?>">
                                        <?php echo htmlspecialchars($category->name); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        <?php else : ?>
                            <p>There are no categories yet</p>
                        <?php endif; ?>
                    </div>
                </div><!-- /.blog-sidebar -->

            </div> <!-- end of row --> 

        </div><!-- /.container -->

        <div class="blog-footer">
            <p>PHPLoversBlog &copy; 2021</p>
            <p>
                <a href="#">Back to top</a>
            </p>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>




