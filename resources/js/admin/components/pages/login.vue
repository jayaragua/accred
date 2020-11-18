<template>
	<!-- <div> -->
		<div class="container">
			   
				<div class="_1adminOverveiw_table_recent _box_shadow  _mar_b30 _p20 col-md-4">
									<div class="login_header">
										<!-- <h1>Gadtc Accreditation</h1> -->
										
										<Icon type="md-contact" color="#4888e9" size="100" />
										<h3>Sign In</h3>
									</div>
									 <div class="space2">
									 	 <Input v-model="data.email" placeholder="Email" clearable />
									 </div>
									<div class="space2">
									 <Input @keyup.enter="login" v-model="data.password" type="password" password placeholder="Password"  />
									</div>
									<div class="login_footer">
									 <Button type="primary" @click="login" :disabled="isLogin" long :loading="isLogin">{{isLogin ? 'loging...' : 'login'}}</Button>	
								<!-- 	 <Button type="default">Cancel</Button> -->
									</div>
			                        
							
				</div>
		</div>
	<!-- </div> -->
</template>

<script>
	export default{
		data(){
		return{
			data:{
				email:'',
				password:'',
			},
			isLogin: false,
		}
	},
	methods:{
		async login(){
			if(this.data.email.trim()=='') return this.error('Email is required')
            if(this.data.password.trim()=='') return this.error('Password is required')
            if(this.data.password.length < 6) return this.error('Incorrect login details')
            this.isLogin = true
            const res = await this.callApi('post','app/login', this.data)
        	if(res.status===200){
        		this.success(res.data.msg)
        		window.location='/'
        	}else{
        		if(res.status===401){
        			this.error(res.data.msg)
        		}else if(res.status==422){
        			this.error(res.data.errors.email[0])
        		} 
        		else{
        			this.swr()
        		}
        	}
        	this.isLogin = false
		},
		 onEnter(){
				alert("Enter clicked")

		},
	}

}
</script>

<style scoped="">
	._1adminOverveiw_table_recent{
		margin:0 auto;
		margin-top: 220px;
	}
	.login_footer{
		text-align: center;
		}
	.login_header{
		text-align: center;
		margin-top: 24px;
		margin-bottom: 24px;
		font-size: 25px;
	}
</style>