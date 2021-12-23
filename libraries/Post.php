<?php
class Post{
	//Init DB Variable
	private $db;
	
	/*
	 *	Constructor
	 */
	public function __construct(){
		$this->db = new Database;
	}
	 
	/*
	 *	Get All Posts
	 */
    public function getAllPosts(){
        $this->db->query("SELECT * FROM posts ORDER BY id DESC");
        //Assign Result Set
        $results = $this->db->resultset();
		
		return $results;
	}

	  
	/*
	 *	Get All Categories
	 */
    public function getAllCategories(){
        $this->db->query("SELECT * FROM categories ORDER BY id");
        //Assign Result Set
        $results = $this->db->resultset();
		
		return $results;
	}


	/*
	 * Get Single Post
	 */
	public function getPost($id){
		$this->db->query("SELECT * FROM posts WHERE id = ".$id);
		$this->db->bind(':id', $id);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}


    /*
	 * Get Posts filter By Category
	 */
	public function getPostsByCategory($category){
		$this->db->query("SELECT * FROM posts WHERE category = $category ORDER BY id DESC");
		$this->db->bind(':category', $category);
	
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	}



    // below for admin section --------------------------------------------------------------------------

    /*
	 *	Get All Posts include category name for admin
	 */
    public function getAllPostsForAdmin(){
        $this->db->query("SELECT posts.*, categories.name FROM posts
				INNER JOIN categories
				ON posts.category = categories.id
				ORDER BY posts.id");
        //Assign Result Set
        $results = $this->db->resultset();
		
		return $results;
	}


	/*
	 * Get Single Category
	 */
	public function getCategory($id){
		$this->db->query("SELECT * FROM categories WHERE id = ".$id);
		$this->db->bind(':id', $id);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}


    /*
	 * Create Post
	 */
	public function createPost($data){
		//Insert Query
		$this->db->query("INSERT INTO posts
					    (title, body, category, author, tags) 
				        VALUES(:title, :body, :category, :author, :tags)");
		//Bind Values
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':category', $data['category']);
		$this->db->bind(':author', $data['author']);
		$this->db->bind(':tags', $data['tags']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}


    /*
	 * Update Post
	 */
	public function updatePost($data){
		//Insert Query
		$this->db->query("UPDATE posts 
                        SET title = :title, body = :body, category = :category, author = :author, tags = :tags
                        WHERE id = :id");
		//Bind Values
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':category', $data['category']);
		$this->db->bind(':author', $data['author']);
		$this->db->bind(':tags', $data['tags']);
		$this->db->bind(':id', $data['id']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}


    /*
	 * Delete Post
	 */
	public function deletePost($id){
		//Insert Query
		$this->db->query('DELETE FROM posts WHERE id = :id');

		//Bind Values
		$this->db->bind(':id', $id);
	
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}


    /*
	 * Create Category
	 */
	public function createCategory($data){
		//Insert Query
		$this->db->query("INSERT INTO categories
					    (name) 
				        VALUES(:name)");
		//Bind Values
		$this->db->bind(':name', $data['name']);
	
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}


    /*
	 * Update Category
	 */
	public function updateCategory($data){
		//Insert Query
		$this->db->query("UPDATE categories SET name = :name WHERE id = :id");

		//Bind Values
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':id', $data['id']);
	
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}


    /*
	 * Delete Category
	 */
	public function deleteCategory($id){
		//Insert Query
		$this->db->query('DELETE FROM categories WHERE id = :id');

		//Bind Values
		$this->db->bind(':id', $id);
	
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}




    // --------------------------------------------------------------------------------------------------------



	/*
	 * Get Topics By Category
	 */
	public function getByCategory($category_id){
		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.category_id = :category_id			
		");
		$this->db->bind(':category_id', $category_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	}
	
	/*
	 * Get Topics By Username
	 */
	public function getByUser($user_id){
		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.user_id = :user_id
		");
		$this->db->bind(':user_id', $user_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}
	  
	/*
	 * Get Total # of Topics
	 */
	public function getTotalTopics(){
		$this->db->query('SELECT * FROM topics');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	
	/*
	 * Get Total # of Categories
	 */
	public function getTotalCategories(){
		$this->db->query('SELECT * FROM categories');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	
	/*
	 * Get Total # of Replies
	 */
	public function getTotalReplies($topic_id){
		$this->db->query('SELECT * FROM replies WHERE topic_id = '.$topic_id);
		$this->db->bind(':topic_id', $topic_id);
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	



	
	/*
	 * Create Topic
	 */
	public function create($data){
		//Insert Query
		$this->db->query("INSERT INTO topics (category_id, user_id, title, body,last_activity)
											VALUES (:category_id, :user_id, :title,:body,:last_activity)");
		//Bind Values
		$this->db->bind(':category_id', $data['category_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':last_activity', $data['last_activity']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}
	

	
}



