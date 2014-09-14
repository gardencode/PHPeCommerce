<?php
//Class for product info (A product ID should be entered when created)
class Product {
    public $id;
    public $name;
    public $categoryId;
    public $categoryName;
    public $description;
    public $imgPath;
    
    public function __construct( $id ) {
        //Get the SQL connection
        $conn = mysqli_connect("localhost", "root", "", "coolshop");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: ".mysqli_connect_error();
        }
        //Get the Product and Category info based on the given product ID
        $myQuery = mysqli_query($conn, "SELECT * FROM product INNER JOIN category ON product.category_id = category.category_id WHERE product_id = ".$id);
        //Set the product's attributes
        while ($row = mysqli_fetch_array($myQuery)) {
            $this->id = $row['product_id'];
            $this->name = $row['product_name'];
            $this->categoryId = $row['category_id'];
            $this->categoryName = $row['category_name'];
            $this->description = $row['product_description'];
            $this->imgPath = $row['product_image'];
        }
    }
    
}

//Test for displaying info of products
$prod = new Product(5);
echo "<h1>".$prod->name." (Product ID = ".$prod->id.")</h1>";
echo "<h2>".$prod->categoryName." (Category ID = ".$prod->categoryId.")</h2>";
echo "<img src='".$prod->imgPath."'  alt='".$prod->name."'/>";
echo "<p>".$prod->description."</p>";

?>