import unittest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

class SearchTestCase(unittest.TestCase):

    def setUp(self):
        self.driver = webdriver.Edge()  # Assuming you are using Microsoft Edge browser
        self.driver.get("http://localhost/software%20project/search.php")  

    def tearDown(self):
        self.driver.quit()

    def click_element_with_js(self, element):
        self.driver.execute_script("arguments[0].click();", element)

    def test_valid_search(self):
        # Test case for valid search
        search_input = self.driver.find_element(By.ID, "search-input")
        search_button = self.driver.find_element(By.ID, "search")

        search_input.send_keys("z")
        self.click_element_with_js(search_button)

    def test_invalid_search(self):
        # Test case for invalid search
        search_input = self.driver.find_element(By.ID, "search-input")
        search_button = self.driver.find_element(By.ID, "search")

        search_input.send_keys("lan")
        self.click_element_with_js(search_button)

if __name__ == '__main__':
    unittest.main()
