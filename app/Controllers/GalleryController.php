<?php
class GalleryController {
    private $galleryModel;

    public function __construct($model) {
        $this->galleryModel = $model;
    }

    // Public: Renders public photo gallery grid
    public function index() {
        $images = $this->galleryModel->getAll()->fetchAll(PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../../views/user/gallery/index.php';
    }
}       