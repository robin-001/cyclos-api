<?php

namespace Angstrom\CyclosApi\Traits;

trait RecordManagementTrait
{
    /**
     * Get data for creating a record
     *
     * @param string $user User identifier
     * @param array $params Query parameters
     * @return array
     */
    public function getDataForCreateRecord(string $user, array $params = []): array
    {
        return $this->get("/users/{$user}/records/data-for-create", $params);
    }

    /**
     * Create a record
     *
     * @param string $user User identifier
     * @param array $data Record data
     * @return array
     */
    public function createRecord(string $user, array $data): array
    {
        return $this->post("/users/{$user}/records", $data);
    }

    /**
     * Get record types
     *
     * @param array $params Query parameters
     * @return array
     */
    public function getRecordTypes(array $params = []): array
    {
        return $this->get("/record-types", $params);
    }

    /**
     * Get record type details
     *
     * @param string $typeId Record type identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function getRecordType(string $typeId, array $fields = []): array
    {
        return $this->get("/record-types/{$typeId}", ['fields' => $fields]);
    }

    /**
     * Search records
     *
     * @param array $params Search parameters
     * @return array
     */
    public function searchRecords(array $params = []): array
    {
        return $this->get("/records", $params);
    }

    /**
     * View record details
     *
     * @param string $recordId Record identifier
     * @param array $fields Fields to include in response
     * @return array
     */
    public function viewRecord(string $recordId, array $fields = []): array
    {
        return $this->get("/records/{$recordId}", ['fields' => $fields]);
    }

    /**
     * Update record
     *
     * @param string $recordId Record identifier
     * @param array $data Record data
     * @return array
     */
    public function updateRecord(string $recordId, array $data): array
    {
        return $this->put("/records/{$recordId}", $data);
    }

    /**
     * Delete record
     *
     * @param string $recordId Record identifier
     * @return void
     */
    public function deleteRecord(string $recordId): void
    {
        $this->delete("/records/{$recordId}");
    }
}
