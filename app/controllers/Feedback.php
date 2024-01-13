<?php

class Feedback
{
    use Controller;

    public function like_brand_comment($idAvisMarque, $idMarque)
    {
        $this->getModel('brand');
        $brandModel = new BrandModel();
        $brandModel->likeBrandComment($idAvisMarque);
        redirect("/brands/show_brand_details&idMarque=$idMarque");
    }

    public function like_vehicle_comment($idAvisVehicle, $idVehicle)
    {
        $this->getModel('vehicle');
        $vehicleModel = new VehicleModel();
        $vehicleModel->likeVehicleComment($idAvisVehicle);
        redirect("/brands/show_vehicle_details&idMarque=$idVehicle");
    }
}
