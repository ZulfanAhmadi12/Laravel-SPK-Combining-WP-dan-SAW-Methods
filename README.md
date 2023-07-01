## About This Project

The Employee Selection Decision Support System is a website that utilizes the Weighted Product and SAW (Simple Additive Weighting) methods to aid in the process of selecting new employees for a company. The system provides a user-friendly interface and offers various functionalities to streamline the employee selection process.

The website allows the user to input alternative options, which in this case are the names of the candidates applying for positions within the company. The user can add alternatives by accessing the "Add Alternative" feature under the "Alternative Settings" menu. A list of added alternatives can be viewed in the "View Alternatives" section, where the user has the ability to delete or modify alternatives as needed. Upon successful addition of an alternative, a notification of success is displayed.

The selection criteria are chosen based on their relevance and importance in the employee recruitment process. The system enables the user to add criteria through the "Criteria Settings" menu on the "Add Criteria" page. Each criterion is assigned a weight that represents its level of significance. The weight scale ranges from 1 to 100. The user can view the list of criteria on the "View Criteria" page, where criteria can be deleted or modified according to the user's requirements.

In addition to criteria, each criterion needs to have its attributes defined. Attributes are divided into two categories: "Cost" and "Benefit." The "Cost" attribute is assigned to criteria that have sub-criteria or variables where lower weights or values are considered better. For example, the "Salary Expectation" criterion may have sub-criteria such as <= RP. 1,000,000 (weight = 1) and RP. 1,000,000 - 2,000,000 (weight = 2). In this case, the sub-criterion with the lower weight, <= RP. 1,000,000, is considered better.

On the other hand, the "Benefit" attribute represents the opposite of the "Cost" attribute. Higher weights are considered better for sub-criteria falling under the "Benefit" attribute. For example, the "Experience" criterion may have sub-criteria such as <= 1 year (weight = 1) and 1-2 years (weight = 2). In this case, the sub-criterion with the higher weight, 1-2 years, is considered better.

The system allows the user to add sub-criteria, also known as variables, through the "Sub-Criteria Settings" menu. It is important to ensure that criteria are defined before adding sub-criteria. The user can enter the name of the sub-criterion, select the corresponding criterion it belongs to, and assign a weight to the sub-criterion. The weight scale ranges from 1 to 5, with 1 being the lowest and 5 being the highest. The list of added sub-criteria can be viewed on the "View Sub-Criteria" page, where they can be deleted or modified based on the user's needs.

## Project's Screenshot

<figure>
    <img src="https://github.com/ZulfanAhmadi12/Laravel-SPK-Metode-WP-dan-SAW/blob/master/spkscreenshot.png"
         alt="Home Top Page" width="700" height="400">
    <figcaption>Screenshot Home Page, at the top of the page.</figcaption>
</figure>