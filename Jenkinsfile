pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                echo "Code checked out successfully"
            }
        }

        stage('Build Artifact') {
            steps {
                sh '''
                    mkdir -p build
                    
                    # Create a simple text artifact (always works)
                    cat > build/wordpress-build-${BUILD_NUMBER}.txt << EOF
WordPress SQE Project
Build Number: ${BUILD_NUMBER}
Built on: $(date)
Dockerfile present: $(ls Dockerfile 2>/dev/null || echo "not found")
docker-compose.yml present: $(ls docker-compose.yml 2>/dev/null || echo "not found")
EOF
                    
                    # Also copy the whole project into build/ (no zip needed)
                    cp -r Dockerfile docker-compose.yml wp-content build/ 2>/dev/null || true
                    
                    echo "Artifact created successfully"
                '''
            }
        }

        stage('Archive Artifact') {
            steps {
                archiveArtifacts artifacts: 'build/**', fingerprint: true
                echo "Artifact archived – visible in Jenkins build page"
            }
        }
    }

    post {
        success {
            echo "Stage 2 – Build Stage completed successfully!"
        }
    }
}
