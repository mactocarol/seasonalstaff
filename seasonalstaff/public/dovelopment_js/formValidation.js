 $(document).ready(function() {



 	 



    $('#add_user_by_admin').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {

            f_name: {

                validators: {

                    notEmpty: {

                        message: 'First name is required and cannot be empty'

                    },

                }

            },
            m_name: {  

                validators: {

                    notEmpty: {

                        message: 'Middle name is required and cannot be empty'

                    },

                }

            },


			l_name: {

                validators: {

                    notEmpty: {

                        message: 'The Last name is required and cannot be empty'

                    },

                }

            },

            username: {

                validators: {

                    notEmpty: {

                        message : 'Username is required and cannot be empty '

                    },

                     remote: {  

                     type: 'POST',

                     data:$("#add_user_by_admin input").serialize(),

                     url: site_url+"Users/User/check_USERNAME_exists",

                     data: function(validator) {

                         return {

                             username: validator.getFieldElements('username').val()

                             };

                        },

                     message: 'This Username is already in use.'     

                     }

                },

            }, 

                       

			email: {

                validators: {

					notEmpty: {

						message : 'The email Field is required and cannot be empty '

					},

					 remote: {  

					 type: 'POST',

					 data:$("#add_user_by_admin input").serialize(),

					 url: site_url+"Users/User/check_email_exists_intable",

					 data: function(validator) {

						 return {

							 //email: $('#email').val()

							 email: validator.getFieldElements('email').val()

							 };

						},

					 message: 'This email is already in use.'     

					 }

				},

			},    

			gender: {

                validators: {

                    notEmpty: {

                        message: 'Gender is required and cannot be empty'

                    },

                }

            },

            plan: {

                validators: {

                    notEmpty: {

                        message: 'Plan is required and cannot be empty'

                    },

                }

            },

            role: {

                validators: {

                    notEmpty: {

                        message: 'User role is required and cannot be empty'

                    },

                }

            },

             mapaddress: {

                validators: {

                    notEmpty: {

                        message: 'Address is required and cannot be empty'

                    },

                }

            },

             longitude: {

                validators: {

                    notEmpty: {

                        message: 'Longitude is required and cannot be empty'

                    },

                }

            },

             latitude: {

                validators: {

                    notEmpty: {

                        message: 'Latitude is required and cannot be empty'

                    },

                }

            },

            country: {

                validators: {

                    notEmpty: {

                        message: 'Country is required and cannot be empty'

                    },

                }

            },

			

			password: {

				validators: {					

					identical: {

                        field: 'con_pass',

                        message: 'The password and its confirm are not the same'

                    },

					stringLength: {

						min: 6 ,

						max: 15,

						message: 'The password length min 6 and max 15 character Long'

					}

				}

			},

			repassword: {

				validators: {					

					identical: {

                        field: 'password',

                        message: 'The password and its confirm are not the same'

                    }

					

				}

			},

        }

    });



 });



  $('#edit_user_by_admin').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {

            f_name: {

                validators: {

                    notEmpty: {

                        message: 'The First name is required and cannot be empty'

                    },

                }

            },
            m_name: {  

                validators: {

                    notEmpty: {

                        message: 'Middle name is required and cannot be empty'

                    },

                }

            },

            l_name: {

                validators: {

                    notEmpty: {

                        message: 'The Last name is required and cannot be empty'

                    },

                }

            },

            username: {

                validators: {

                    notEmpty: {

                        message : 'Username is required and cannot be empty '

                    },

                     remote: {  

                     type: 'POST',

                     data:$("#edit_user_by_admin input").serialize(),

                     url: site_url+"Users/User/check_USERNAME_exists/"+id,

                     data: function(validator) {

                         return {

                             username: validator.getFieldElements('username').val()

                             };

                        },

                     message: 'This Username is already in use.'     

                     }

                },

            }, 


                       

            email: {

                validators: {

                    notEmpty: {

                        message : 'The email Field is required and cannot be empty '

                    },

                     remote: {  

                     type: 'POST',

                     data:$("#edit_user_by_admin input").serialize(),

                     // url: site_url+"users/user/check_email_exists_intable",

                      url: site_url+"Users/User/check_email_exists/"+id,

                     data: function(validator) {

                         return {

                             //email: $('#email').val()

                             email: validator.getFieldElements('email').val()

                             };

                        },

                     message: 'This email is already in use.'     

                     }

                },

            },    

            gender: {

                validators: {

                    notEmpty: {

                        message: 'Gender is required and cannot be empty'

                    },

                }

            },

            plan: {

                validators: {

                    notEmpty: {

                        message: 'Plan is required and cannot be empty'

                    },

                }

            },

            role: {

                validators: {

                    notEmpty: {

                        message: 'User role is required and cannot be empty'

                    },

                }

            },

             mapaddress: {

                validators: {

                    notEmpty: {

                        message: 'Address is required and cannot be empty'

                    },

                }

            },

             longitude: {

                validators: {

                    notEmpty: {

                        message: 'Longitude is required and cannot be empty'

                    },

                }

            },

             latitude: {

                validators: {

                    notEmpty: {

                        message: 'Latitude is required and cannot be empty'

                    },

                }

            },

            country: {

                validators: {

                    notEmpty: {

                        message: 'Country is required and cannot be empty'

                    },

                }

            },

            

            password: {

                validators: {                   

                    identical: {

                        field: 'con_pass',

                        message: 'The password and its confirm are not the same'

                    },

                    stringLength: {

                        min: 6 ,

                        max: 15,

                        message: 'The password length min 6 and max 15 character Long'

                    }

                }

            },

            repassword: {

                validators: {                   

                    identical: {

                        field: 'password',

                        message: 'The password and its confirm are not the same'

                    }

                    

                }

            },

        }

    });



 $('#offers').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {

            offer: {

                validators: {

                    notEmpty: {

                        message: 'Offer name is required and cannot be empty'

                    },

                }

            },

            offerdate: {

                validators: {

                    notEmpty: {

                        message: 'Offer Apply Date is required and cannot be empty'

                    },

                }

            },

             offerTillDate: {

                validators: {

                    notEmpty: {

                        message: 'Offer valid date is required and cannot be empty'

                    },

                }

            },

            description: {

                validators: {

                    notEmpty: {

                        message: 'Offer Description is required and cannot be empty'

                    },

                }

            },

        }

    });




 $('#jobs').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {
            employee: {

                validators: {

                    notEmpty: {

                        message: 'Employee  is required and cannot be empty'

                    },

                }

            },
            jobIDUnique: { 

                validators: {

                    notEmpty: {

                        message : 'JOb Id is required and cannot be empty '

                    },

                     remote: {  

                     type: 'POST',

                     data:$("#add_user_by_admin input").serialize(),

                     url: site_url+"Jobs/Job/check_JobId_exists/"+id,

                     data: function(validator) {

                         return {

                             jobIDUnique: validator.getFieldElements('jobIDUnique').val()

                             };

                        },

                     message: 'This Job id is already in use. Job Id should be unique.'     

                     }

                },

            },

            jobname: {

                validators: {

                    notEmpty: {

                        message: 'Job name is required and cannot be empty'

                    },

                }

            },
            job_cat_id: {

                validators: {

                    notEmpty: {

                        message: 'Job Category is required and cannot be empty'

                    },

                }

            },

             designation: {

                validators: {

                    notEmpty: {

                        message: 'Designation is required and cannot be empty'

                    },

                }

            },
             skills: {

                validators: {

                    notEmpty: {

                        message: 'Skills are required and cannot be empty'

                    },

                }

            },
             no_of_jobs: {

                validators: {

                    notEmpty: {

                        message: 'Number of jobs are required and cannot be empty'

                    },

                }

            },
            Salary: {

                validators: {

                    notEmpty: {

                        message: 'Salary is required and cannot be empty'

                    },

                }

            },
             mapaddress: {

                validators: {

                    notEmpty: {

                        message: 'Location is required and cannot be empty'

                    },

                }

            },


            jobdate: {

                validators: {

                    notEmpty: {

                        message: 'Job Apply Date is required and cannot be empty'

                    },

                }

            },

             jobTillDate: {

                validators: {

                    notEmpty: {

                        message: 'Job last date is required and cannot be empty'

                    },

                }

            },

            description: {

                validators: {

                    notEmpty: {

                        message: 'Job Description is required and cannot be empty'

                    },

                }

            },

        }

    });

   


 $('#Industry_form').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {
            
             industry: {

                validators: {

                    notEmpty: {

                        message: 'Industry is required and cannot be empty'

                    },

                }

            },
          
     
        

        }

    });

  $('#Benefit_form').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {
            
             name: {

                validators: {

                    notEmpty: {

                        message: 'Benefit name is required and cannot be empty'

                    },

                }

            },
          
     
        

        }

    });

    $('#Package_form').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {
            
             name: {

                validators: {

                    notEmpty: {

                        message: 'Package name is required and cannot be empty'

                    },

                }

            },
              price: {

                validators: {

                    notEmpty: {

                        message: 'Package price is required and cannot be empty'

                    },

                }

            },
          
     
        

        }

    });

    $('#skill_form_validation').bootstrapValidator({

        //container: '#messages',

        feedbackIcons: {

            valid: 'glyphicon glyphicon-ok',

            invalid: 'glyphicon glyphicon-remove',

            validating: 'glyphicon glyphicon-refresh'

        },

        fields: {
            
             skills: {

                validators: {

                    notEmpty: {

                        message: 'Skills is required and cannot be empty'

                    },

                }

            },
          
     
        

        }

    });












// /*************tag Input in add job form*************************/
  


// (function($){

//     $(function(){

//                       $('#category').tagsinput({
//               typeahead: {
//                 source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
//               },
//               freeInput: true
//             });
//             $('#category').on('itemAdded', function(event) {
//                 setTimeout(function(){
//                     $(">#category input[type=text]",".bootstrap-tagsinput").val("");
//                 }, 1);
//             });

//     });

// })(jQuery)

// /*************************************/
//  