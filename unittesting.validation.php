<?php

class ValidationTest extends \PHPUnit\Framework\TestCase
{
    public function testCheckUserExists()
    {
        // Mock Database class (if necessary)
        $dbMock = $this->createMock(Database::class);

        // Setup mock to return a count of 1 (user exists) for specific scenarios
        $dbMock->method('query')
            ->will($this->onConsecutiveCalls(
                $this->returnValue(1), // User with provided username and email exists
                $this->returnValue(1), // User with provided username exists, but not with email
                $this->returnValue(1), // User with provided email exists, but not with username
                $this->returnValue(0), // User with neither username nor email exists
                $this->returnValue(0)  // Edge case: Empty username or email
            ));

        // Instantiate Validation class with the mocked Database instance
        $validation = new Validation($dbMock);

        // Test scenarios
        $this->assertTrue($validation->checkUserExists('existing_username', 'existing_email')); // User with provided username and email exists
        $this->assertTrue($validation->checkUserExists('existing_username', 'non_existing_email')); // User with provided username exists, but not with email
        $this->assertTrue($validation->checkUserExists('non_existing_username', 'existing_email')); // User with provided email exists, but not with username
        $this->assertFalse($validation->checkUserExists('non_existing_username', 'non_existing_email')); // User with neither username nor email exists
        $this->assertFalse($validation->checkUserExists('', '')); // Edge case: Empty username or email
    }
}