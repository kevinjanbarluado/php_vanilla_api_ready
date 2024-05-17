<?php
session_start();
require_once('../src/gib_dbconn.php');

class ApiClass
{

    // Method to handle FetchData endpoint
    public function fetchData()
    {
        // Your logic to fetch data
        $data = array(
            'message' => 'Data fetched successfully',
            // Add more data fields if needed
        );
        return json_encode($data);
    }

    // Method to handle InsertData endpoint
    public function insertData($data)
    {
        // Your logic to insert data

        // Decode the JSON data
        $decodedData = json_decode($data, true);

        if ($decodedData === null) {
            // Handle invalid JSON data
            return json_encode(array(
                'error' => 'Invalid JSON data'
            ));
        }

        // Assuming you want to return the inserted data
        $responseData = array(
            'message' => 'Data inserted successfully',
            'data' => $decodedData
        );

        return json_encode($responseData);
    }
    

    //update Post
    /*
    @int id
    @string value
    @string col
    */
    public function updatePost($data)
    {
        // Your logic to insert data
        $message = 'Post updated successfully';
        $status = true;
        // Decode the JSON data
        $decodedData = json_decode($data, true);

        if ($decodedData === null) {
            // Handle invalid JSON data
            return json_encode(array(
                'error' => 'Invalid JSON data'
            ));
        }

        $sql = "UPDATE gib_posts SET " . $decodedData['col'] . " = " . $decodedData['value'] . " WHERE id = '" . $decodedData['id']."'";
        $result = $GLOBALS['conn']->query($sql);
        if ($GLOBALS['conn']->error) {
            $message = $GLOBALS['conn']->error;
            $status = false;
        }

        // Assuming you want to return the inserted data
        $responseData = array(
            'message' => $message,
            'status' => $status,
            'data' => $decodedData
        );

        return json_encode($responseData);
    }

    // Method to handle UpdateData endpoint
    public function updateData($data)
    {
        // Your logic to update data
        $responseData = array(
            'message' => 'Data updated successfully',
            'data' => $data // Assuming you want to return the updated data
        );
        return json_encode($responseData);
    }

    // Method to handle DeleteData endpoint
    public function deleteData()
    {
        // Your logic to delete data
        $responseData = array(
            'message' => 'Data deleted successfully',
            // Add more data fields if needed
        );
        return json_encode($responseData);
    }
}
