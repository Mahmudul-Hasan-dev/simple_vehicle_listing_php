<?php
namespace App\Classes;

class VehicleManager extends VehicleBase implements VehicleActions {
    use FileHandler;

    private $filename;

    public function __construct($name, $type, $price, $image) {
        parent::__construct($name, $type, $price, $image);
        $this->filename = __DIR__ . '/../../data/vehicles.json';
    }

    public function addVehicle($data) {
        $vehicles = $this->getVehicles();
        $vehicles[] = $data;
        $this->writeToFile($this->filename, $vehicles);
    }

    public function editVehicle($id, $data) {
        $vehicles = $this->getVehicles();
        if (isset($vehicles[$id])) {
            $vehicles[$id] = $data;
            $this->writeToFile($this->filename, $vehicles);
        }
    }

    public function deleteVehicle($id) {
        $vehicles = $this->getVehicles();
        if (isset($vehicles[$id])) {
            unset($vehicles[$id]);
            $vehicles = array_values($vehicles); // Reindex the array
            $this->writeToFile($this->filename, $vehicles);
        }
    }

    public function getVehicles() {
        return $this->readFromFile($this->filename);
    }

    public function getDetails() {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'price' => $this->price,
            'image' => $this->image,
        ];
    }
}
?>