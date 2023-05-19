from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.edge.service import Service
from selenium.webdriver.edge.options import Options
from selenium.webdriver.edge.webdriver import WebDriver

import time

edge_options = Options()
edge_options.use_chromium = True
edge_service = Service("E:\\")
driver = WebDriver(service=edge_service, options=edge_options)

# Wait for the search input field to be visible
wait = WebDriverWait(driver, 20)  # Maximum wait time of 20 seconds

# Open the search page of the online store
driver.get("http://localhost/software%20project/search.php")

# Define a list of test inputs for one or two letters and the whole word
test_inputs = ["A", "DI", "Resistor","z"]  # Add more test inputs if needed

# Perform the test for each input
for input_text in test_inputs:
    # Locate the search input field on the page
    search_input = wait.until(EC.visibility_of_element_located((By.CSS_SELECTOR, "#search-input")))

    # Clear the input field
    search_input.clear()

    # Enter the test input in the search field
    search_input.send_keys(input_text)


    search_button = driver.find_element(By.CSS_SELECTOR, "#search")
    driver.execute_script("arguments[0].click();", search_button)


    # Wait for the search results to load (adjust the sleep time if needed)
    time.sleep(2)  # Wait for 2 seconds (you can adjust this value)

    # Get the search results
    search_results = driver.find_elements(By.CSS_SELECTOR, ".products")
    print(f"Search test for '{input_text}': {len(search_results)} results found.")

# Close the browser
driver.quit()
