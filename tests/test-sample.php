<?php
/**
 * Sample WordPress Unit Test
 */

class SampleTest extends WP_UnitTestCase {

    // Test that WordPress loads core functions
    public function test_wp_environment() {
        $this->assertTrue( function_exists( 'get_option' ) );
    }

    // Test add_option and get_option backend functions
    public function test_add_and_get_option() {
        add_option( 'sqe_test_option', 'hello world' );
        $value = get_option( 'sqe_test_option' );
        $this->assertEquals( 'hello world', $value );
    }
}

