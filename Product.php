<?php
class Product {
    public $id, $name, $category, $desc, $price, $rating, $image;

    function __construct($id, $name, $category, $desc, $price, $rating, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->desc = $desc;
        $this->price = $price;
        $this->rating = $rating;
        $this->image = $image;
    }

    function displayInTable() {
        return "<tr>
            <td><a href='view.php?id={$this->id}'>{$this->id}</a></td>
            <td>{$this->name}</td>
            <td>{$this->category}</td>
            <td>{$this->desc}</td>
            <td>{$this->price}</td>
            <td><img src='images/{$this->image}' width='60'></td>
            <td>
                <a href='edit.php?id={$this->id}'><button>Edit</button></a>
                <a href='delete.php?id={$this->id}'><button>Delete</button></a>
            </td>
        </tr>";
    }

    function displayProductPage() {
        return "<main>
            <h1>{$this->name}</h1>
            <img src='images/{$this->image}' width='200'>
            <p><strong>Category:</strong> {$this->category}</p>
            <p><strong>Description:</strong> {$this->desc}</p>
            <p><strong>Price:</strong> {$this->price}</p>
            <p><strong>Rating:</strong> {$this->rating}</p>
        </main>";
    }
}
?>
